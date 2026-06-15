<?php

namespace App\Services\command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PostmanGenerator
{
    /**
     * الميثود الأساسية لتوليد الكوليكشن
     */
    public static function generate(string $model)
    {
        $modelClass = "App\\Models\\{$model}";
        $table = class_exists($modelClass) ? (new $modelClass)->getTable() : Str::snake(Str::pluralStudly($model));

        if (!Schema::hasTable($table)) return;

        $columns = Schema::getColumnListing($table);

        // جلب أول سجل من الداتابيز (اللي السيدر لسه رماه) عشان نستخدمه كـ Example
        $sampleData = DB::table($table)->first();
        $sampleId = $sampleData->id ?? 1;

        $baseUrl = "{{base_url}}/api/" . Str::kebab(Str::plural($model));

        $items = [
            self::makeItem("List all " . Str::plural($model), "GET", $baseUrl),
            self::makeItem("Get single " . $model, "GET", $baseUrl . "/{$sampleId}"),
            self::makeItem("Create " . $model, "POST", $baseUrl, self::preparePayload($columns, (array)$sampleData)),
            self::makeItem("Update " . $model, "PUT", $baseUrl . "/{$sampleId}", self::preparePayload($columns, (array)$sampleData)),
            self::makeItem("Delete " . $model, "DELETE", $baseUrl . "/{$sampleId}"),
        ];

        $collection = [
            'info' => [
                'name' => "Cleany - {$model} Module",
                'description' => "Auto-generated collection for {$model} based on database schema and seeders.",
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
            ],
            'item' => $items,
            'auth' => [
                'type' => 'bearer',
                'bearer' => [['key' => 'token', 'value' => '{{auth_token}}', 'type' => 'string']]
            ]
        ];

        // حفظ الملف محلياً في الـ Storage
        $fileName = Str::snake($model) . "_collection.json";
        $path = storage_path("app/postman/{$fileName}");
        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $collection;
    }

    /**
     * تجهيز الـ Payload بناءً على الداتا الحقيقية من الداتابيز
     */
    private static function preparePayload(array $columns, array $existingData)
    {
        $payload = [];
        foreach ($columns as $column) {
            // استثناء حقول النظام
            if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at', 'email_verified_at'])) continue;

            // لو السجل موجود في الداتابيز، خد قيمته الحقيقية
            if (isset($existingData[$column])) {
                $payload[$column] = $existingData[$column];
            } else {
                // Fallback لو الجدول لسه فاضي
                $payload[$column] = Str::contains($column, 'email') ? "test@example.com" : "sample_value";
            }
        }
        return $payload;
    }

    /**
     * بناء هيكل الـ Request لكل Entry في بوستمان
     */
    private static function makeItem($name, $method, $url, $body = null)
    {
        $urlParts = explode('/', str_replace('{{base_url}}/', '', $url));

        $item = [
            'name' => $name,
            'request' => [
                'method' => $method,
                'header' => [
                    ['key' => 'Accept', 'value' => 'application/json', 'type' => 'text'],
                    ['key' => 'Content-Type', 'value' => 'application/json', 'type' => 'text'],
                ],
                'url' => [
                    'raw' => $url,
                    'host' => ['{{base_url}}'],
                    'path' => $urlParts
                ],
            ]
        ];

        if ($body && in_array($method, ['POST', 'PUT'])) {
            $item['request']['body'] = [
                'mode' => 'raw',
                'raw' => json_encode($body, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
                'options' => ['raw' => ['language' => 'json']]
            ];
        }

        return $item;
    }
}
