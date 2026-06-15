<?php

namespace App\Services\command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SeederGenerator
{
    private static array $coolImages = [
        'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
        'https://images.unsplash.com/photo-1461747823400-487cf1852d7e',
        'https://images.unsplash.com/photo-1504639725590-34d0984388bd',
    ];

    private static array $arabicWords = ['تجريبي', 'افتراضي', 'جديد', 'مميز', 'مطور'];

    /**
     * الماكينة الأساسية لبناء الموديل بالكامل
     */
    public static function make(string $model)
    {
        $modelClass = "App\\Models\\{$model}";
        $table = class_exists($modelClass) ? (new $modelClass)->getTable() : Str::snake(Str::pluralStudly($model));

        if (!Schema::hasTable($table)) return;

        // 1. توليد الملفات الأساسية للارافيل
        self::generateFactory($model, $table);
        self::generateSeeder($model, $table);
        self::appendToDatabaseSeeder($model);

        // 2. توليد التوثيق (Markdown)
        self::generateMarkdownDoc($model, $table);

        // 3. توليد مجموعة بوست مان (Postman Collection)
        self::generatePostmanCollection($model, $table);
    }

    private static function generateSeeder($model, $table)
    {
        $columns = Schema::getColumnListing($table);
        $recordsCount = 10;
        $recordsArray = "";

        for ($i = 0; $i < $recordsCount; $i++) {
            $fields = "";
            foreach ($columns as $column) {
                if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) continue;

                $value = self::guessExpertValue($column, $table, $i);
                $fields .= "                '{$column}' => {$value},\n";
            }

            $fields .= "                'created_at' => now(),\n";
            $fields .= "                'updated_at' => now(),\n";

            $recordsArray .= "            [\n{$fields}            ],\n";
        }

        $stub = "<?php\n\nnamespace Database\Seeders;\n\nuse Illuminate\Database\Seeder;\nuse Illuminate\Support\Str;\nuse Illuminate\Support\Facades\DB;\n\nclass {$model}Seeder extends Seeder\n{\n    public function run(): void\n    {\n        DB::table('{$table}')->insert([\n{$recordsArray}        ]);\n    }\n}";

        File::put(database_path("seeders/{$model}Seeder.php"), $stub);
    }

    private static function guessExpertValue($column, $table, $index)
    {
        $columnType = Schema::getColumnType($table, $column);

        if (Str::endsWith($column, '_id')) {
            $relatedTable = Str::plural(Str::replaceLast('_id', '', $column));
            $condition = Schema::hasColumn($relatedTable, 'active') ? "->where('active', 1)" : "";
            return "DB::table('{$relatedTable}'){$condition}->inRandomOrder()->value('id') ?? 1";
        }

        if (Str::endsWith($column, '_at')) return "now()";

        if (in_array($columnType, ['integer', 'tinyint', 'smallint', 'boolean', 'bigint'])) {
            return rand(0, 1);
        }
        if (in_array($columnType, ['integer', 'bigint', 'unsignedInteger'])) {
            return rand(1, 10); // بدلاً من 0 و 1 عشان الـ IDs
        }
        if (in_array($columnType, ['boolean', 'tinyint'])) {
            return rand(0, 1); // الـ boolean الحقيقي
        }

        if (Str::endsWith($column, '_ar')) {
            $word = self::$arabicWords[array_rand(self::$arabicWords)];
            $label = Str::replace(['_ar', '_'], ' ', $column);
            return "'{$label} {$word} ' . Str::random(3)";
        }

        if ($columnType === 'enum' || in_array($column, ['role', 'status'])) {
            try {
                $results = DB::select("SHOW COLUMNS FROM `{$table}` WHERE Field = ?", [$column]);
                if (!empty($results) && isset($results[0]->Type)) {
                    preg_match('/^enum\((.*)\)$/', $results[0]->Type, $matches);
                    if (isset($matches[1])) return "collect([" . $matches[1] . "])->random()";
                }
            } catch (\Exception $e) {
            }
        }

        if (preg_match('/(slug|email|username|code|phone|password|token|title|name|desc)/i', $column)) {
            if (Str::contains($column, 'email')) return "'user_' . Str::lower(Str::random(8)) . '_{$index}@example.com'";
            if (Str::contains($column, 'password')) return "bcrypt('password')";
            if (Str::contains($column, 'phone')) return "'01' . rand(100, 999) . rand(1000, 9999) . {$index}";
            if (Str::contains($column, 'slug')) return "'slug-' . Str::lower(Str::random(6)) . '-' . {$index}";
            return "Str::title('{$column}') . '_' . Str::random(5)";
        }

        if (preg_match('/(image|img|file|logo)/i', $column)) {
            return "collect(['" . implode("','", self::$coolImages) . "'])->random()";
        }

        return "'Sample_' . Str::random(5)";
    }

    private static function generateMarkdownDoc($model, $table)
    {
        $columns = Schema::getColumnListing($table);
        $actualPath = self::guessActualRoutePath($model) ?? Str::kebab(Str::plural($model));
        $baseUrl = ltrim($actualPath, '/');

        $md = "# 📘 API Guide: {$model}\n\n";
        $md .= "This documentation is auto-generated for the **{$table}** table.\n\n";
        $md .= "### 🚀 Endpoints\n";
        $md .= "| Action | Method | Endpoint | Auth |\n";
        $md .= "| :--- | :--- | :--- | :--- |\n";
        $md .= "| List All | `GET` | `/{$baseUrl}` | Bearer |\n";
        $md .= "| View One | `GET` | `/{$baseUrl}/{id}` | Bearer |\n";
        $md .= "| Create | `POST` | `/{$baseUrl}` | Bearer |\n";
        $md .= "| Update | `PUT` | `/{$baseUrl}/{id}` | Bearer |\n";
        $md .= "| Delete | `DELETE` | `/{$baseUrl}/{id}` | Bearer |\n\n";

        $md .= "### 📋 Database Schema\n";
        $md .= "| Column | Type | Description |\n";
        $md .= "| :--- | :--- | :--- |\n";
        foreach ($columns as $column) {
            $type = Schema::getColumnType($table, $column);
            $md .= "| `{$column}` | *{$type}* | Field from database |\n";
        }

        $path = base_path("docs/api/");
        File::ensureDirectoryExists($path);
        File::put($path . Str::snake($model) . ".md", $md);
    }

    private static function generatePostmanCollection($model, $table)
    {
        // جلب الـ URI الحقيقي من لارافيل مباشرة
        $actualPath = self::guessActualRoutePath($model);

        if (!$actualPath) {
            // لو ملقاش روت، يضيف اسم الموديل مباشرة كـ fallback
            $baseUrl = "{{base_url}}/" . Str::kebab(Str::plural($model));
        } else {
            // استخدام المسار الحقيقي (v1/users مثلاً) بدون إجبار /api
            $baseUrl = "{{base_url}}/" . ltrim($actualPath, '/');
        }

        $modelClass = "App\\Models\\{$model}";
        $allColumns = Schema::getColumnListing($table); // كل أعمدة الجدول لاستخدامها في fields
        $searchable = [];
        $filterable = [];
        $sortable = ['id', 'created_at'];

        if (class_exists($modelClass)) {
            $modelInstance = new $modelClass;
            $searchable = property_exists($modelInstance, 'searchable') ? array_filter($modelInstance->searchable) : [];
            $filterable = property_exists($modelInstance, 'filterable') ? array_filter($modelInstance->filterable) : [];
            $sortable = property_exists($modelInstance, 'allowedFields') ? $modelInstance->allowedFields : $sortable;
        }

        $realData = DB::table($table)->first();
        $sampleId = $realData->id ?? 1;

        $advancedParams = [];
        if (!empty($searchable)) {
            $advancedParams[] = ['key' => 'search', 'value' => '', 'description' => 'Search in: ' . implode(', ', $searchable)];
        }
        foreach ($filterable as $filter) {
            $advancedParams[] = ['key' => $filter, 'value' => $realData->{$filter} ?? '', 'description' => "Filter by {$filter}"];
        }

        // إضافة باراميتر fields مع وصف كامل لكل الأعمدة المتاحة في الداتابيز
        $advancedParams[] = [
            'key' => 'fields',
            'value' => implode(',', array_slice($allColumns, 0, 3)), // مثال لأول 3 أعمدة
            'description' => 'Select specific fields (comma separated). Available: ' . implode(', ', $allColumns)
        ];

        $advancedParams[] = ['key' => 'sort_by', 'value' => 'id', 'description' => 'Sort by: ' . implode(', ', $sortable)];
        $advancedParams[] = ['key' => 'sort_order', 'value' => 'desc', 'description' => 'asc | desc'];
        $advancedParams[] = ['key' => 'per_page', 'value' => '10', 'description' => 'Pagination limit'];

        $items = [
            self::buildPostmanItem("1. [List] Get All {$model}", "GET", $baseUrl),
            self::buildPostmanItem("2. [Pipeline] Search & Filter {$model}", "GET", $baseUrl, null, $advancedParams),
            self::buildPostmanItem("3. [Show] View One {$model}", "GET", "{$baseUrl}/{$sampleId}"),
            self::buildPostmanItem("4. [Store] Create New {$model}", "POST", $baseUrl, self::getPayload($model, $table, $realData)),
            self::buildPostmanItem("5. [Update] Edit {$model}", "PUT", "{$baseUrl}/{$sampleId}", self::getPayload($model, $table, $realData)),
            self::buildPostmanItem("6. [Delete] Remove {$model}", "DELETE", "{$baseUrl}/{$sampleId}"),
        ];

        $collection = [
            'info' => [
                'name' => "{$model} API Module",
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
            ],
            'item' => $items,
            'auth' => [
                'type' => 'bearer',
                'bearer' => [['key' => 'token', 'value' => '{{auth_token}}', 'type' => 'string']]
            ]
        ];

        $path = storage_path("app/postman/");
        File::ensureDirectoryExists($path);
        File::put($path . Str::snake($model) . "_collection.json", json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private static function guessActualRoutePath($model)
    {
        $allRoutes = Route::getRoutes();
        foreach ($allRoutes as $route) {
            $action = $route->getActionName();
            $uri = $route->uri();

            // مطابقة الكنترولر بغض النظر عن الـ Namespace
            if (Str::contains($action, "{$model}Controller@index")) {
                // تنظيف الـ URI من البراميترز
                return preg_replace('/\{.*\}/', '', $uri);
            }
        }
        return null;
    }

    private static function getPayload($model, $table, $realData)
    {
        $columns = Schema::getColumnListing($table);
        $payload = [];
        foreach ($columns as $column) {
            if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) continue;

            $value = $realData->$column ?? null;

            if (Str::endsWith($column, '_id')) {
                $payload[$column] = $value ? (int)$value : 1;
            } else {
                $payload[$column] = $value ?? (Str::endsWith($column, '_ar') ? "تجريبي" : "Sample");
            }
        }
        return $payload;
    }

    private static function buildPostmanItem($name, $method, $url, $body = null, $queryParams = [], $table = null)
    {
        $mode = 'raw';
        $finalBody = null;

        if ($body) {
            if ($method === 'POST') {
                $mode = 'formdata';
                $finalBody = [];
                foreach ($body as $key => $value) {
                    // لو الحقل صورة أو ملف
                    $isFile = preg_match('/(image|img|file|logo|avatar|photo)/i', $key);
                    $finalBody[] = [
                        'key' => $key,
                        'value' => $isFile ? "" : $value, // في الفورم داتا بنسيب الفاليو فاضية لو ملف عشان اليوزر يرفعه
                        'type' => $isFile ? 'file' : 'text'
                    ];
                }
            } elseif ($method === 'PUT' || $method === 'PATCH') {
                $mode = 'urlencoded';
                $finalBody = [];
                foreach ($body as $key => $value) {
                    $finalBody[] = ['key' => $key, 'value' => $value, 'type' => 'text'];
                }
            } else {
                $finalBody = json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }

        return [
            'name' => $name,
            'request' => [
                'method' => $method,
                'url' => ['raw' => $url, 'host' => ['{{base_url}}'], 'path' => array_values(array_filter(explode('/', str_replace('{{base_url}}', '', $url)))), 'query' => $queryParams],
                'body' => $finalBody ? [
                    'mode' => $mode,
                    $mode => ($mode === 'raw') ? $finalBody : $finalBody
                ] : null,
            ]
        ];
    }

    private static function generateFactory($model, $table)
    {
        $columns = Schema::getColumnListing($table);
        $definition = "";
        foreach ($columns as $column) {
            if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) continue;
            $line = "'{$column}' => ";
            if (Str::endsWith($column, '_id')) $line .= "1,";
            elseif (Str::contains($column, 'email')) $line .= "\$this->faker->unique()->safeEmail,";
            elseif (Str::contains($column, 'password')) $line .= "bcrypt('password'),";
            else $line .= "\$this->faker->word,";
            $definition .= "            {$line}\n";
        }
        $stub = "<?php\nnamespace Database\Factories;\nuse App\Models\\{$model};\nuse Illuminate\Database\Eloquent\Factories\Factory;\nclass {$model}Factory extends Factory {\n    protected \$model = {$model}::class;\n    public function definition(): array {\n        return [\n{$definition}        ];\n    }\n}";
        File::put(database_path("factories/{$model}Factory.php"), $stub);
    }

    private static function appendToDatabaseSeeder(string $model)
    {
        $seederPath = database_path('seeders/DatabaseSeeder.php');
        if (!File::exists($seederPath)) return;

        $content = File::get($seederPath);
        $seederName = "{$model}Seeder::class";

        // 1. التأكد إن الموديل مش مضاف قبل كدة عشان م نكررش السطور
        if (Str::contains($content, $seederName)) return;

        // 2. البحث عن فنكشن الـ run ومحتواها
        // الـ Pattern ده بيدور على فنكشن run وبيمسك كل اللي جواها لحد القوس المقفول
        $pattern = '/(public function run\(\): void\s*\{)(.*?)(\s*\})/s';

        if (preg_match($pattern, $content, $matches)) {
            $prefix = $matches[1]; // بداية الفنكشن {
            $existingContent = rtrim($matches[2]); // المحتوى الحالي (مع تنظيف المسافات في الآخر)
            $suffix = $matches[3]; // القوس المقفول }

            // 3. بناء المحتوى الجديد: القديم + السطر الجديد في سطر لوحده
            $newCall = "\n        \$this->call({$seederName});";
            $updatedContent = $prefix . $existingContent . $newCall . "\n    " . $suffix;

            // 4. استبدال المحتوى القديم بالجديد في الملف
            $content = preg_replace($pattern, $updatedContent, $content);

            File::put($seederPath, $content);
        }
    }
}
