<?php

namespace App\Services\command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RequestGenerator
{
    public static function make(string $model)
    {
        try {
            $modelClass = "App\\Models\\{$model}";
            $table = class_exists($modelClass)
                ? (new $modelClass)->getTable()
                : Str::snake(Str::pluralStudly($model));

            if (!Schema::hasTable($table)) {
                return "❌ Table '{$table}' does not exist!";
            }

            $baseFolder = app_path("Http/Requests/Admin/{$model}");
            File::ensureDirectoryExists($baseFolder);

            $columns = Schema::getColumnListing($table);
            $columnsFullInfo = [];
            foreach ($columns as $col) {
                $info = DB::selectOne("
                    SELECT COLUMN_TYPE, IS_NULLABLE 
                    FROM INFORMATION_SCHEMA.COLUMNS 
                    WHERE TABLE_NAME = ? AND COLUMN_NAME = ? 
                      AND TABLE_SCHEMA = DATABASE()
                ", [$table, $col]);
                if ($info) $columnsFullInfo[$col] = $info;
            }

            $generateRules = function ($isUpdate = false) use ($columnsFullInfo, $table, $model) {
                $rules = [];
                $routeParam = Str::camel($model);
                $skip = ['id', 'created_at', 'updated_at', 'deleted_at'];

                foreach ($columnsFullInfo as $col => $info) {
                    if (in_array($col, $skip)) continue;

                    $type = $info->COLUMN_TYPE;
                    $nullable = $info->IS_NULLABLE === 'YES';
                    $rule = [];

                    // --- [تعديل الخبير: تحديد أولوية نوع الحقل] ---

                    // 1. فحص هل الحقل مخصص للملفات/الصور (الأولوية القصوى)
                    $isMedia = preg_match('/(image|img|file|attachment|photo|picture|logo|avatar)/i', $col);

                    if ($isMedia) {
                        $rule[] = 'file|image|max:2048';
                        // ملاحظة: هنا تجاهلنا الـ string تماماً حتى لو كان العمود varchar
                    }
                    // 2. معالجة العلاقات Foreign Keys
                    elseif (Str::endsWith($col, '_id')) {
                        $relatedTable = Str::snake(Str::plural(Str::replaceLast('_id', '', $col)));
                        if (Schema::hasTable($relatedTable)) {
                            $rule[] = "exists:{$relatedTable},id";

                            $relatedColumns = Schema::getColumnListing($relatedTable);
                            $displayCol = 'name';
                            $possibleNames = ['name', 'title', 'username', 'label', 'phone', 'subject'];

                            foreach ($possibleNames as $pName) {
                                if (in_array($pName, $relatedColumns)) {
                                    $displayCol = $pName;
                                    break;
                                }
                            }
                            $rule[] = "display_field:{$displayCol}";
                        }
                    }
                    // 3. الأنواع الأساسية (تنفذ فقط إذا لم يكن الحقل ميديا أو علاقة)
                    else {
                        if (preg_match('/^varchar\((\d+)\)$/i', $type, $m)) $rule[] = "string|max:{$m[1]}";
                        elseif (preg_match('/^enum\((.+)\)$/i', $type, $m)) $rule[] = 'in:' . implode(',', array_map(fn($v) => trim($v, " '\""), explode(',', $m[1])));
                        elseif (in_array($type, ['text', 'mediumtext', 'longtext'])) $rule[] = 'string';
                        elseif (preg_match('/int|bigint/i', $type)) $rule[] = 'integer';
                        elseif (preg_match('/tinyint\(1\)/i', $type)) $rule[] = 'boolean';
                        elseif (preg_match('/decimal|float|double/i', $type)) $rule[] = 'numeric';
                        elseif (preg_match('/date|datetime|timestamp/i', $type)) $rule[] = 'date';
                        elseif ($type === 'json') $rule[] = 'array';
                    }

                    // 4. معالجة الـ Unique (تضاف للجميع عدا الـ ID والعلاقات)
                    $unique = DB::select("SHOW INDEX FROM {$table} WHERE Column_name='{$col}' AND Non_unique=0");
                    if (!empty($unique) && !Str::endsWith($col, '_id')) {
                        $rule[] = $isUpdate
                            ? "unique:{$table},{$col},'.\$this->route('{$routeParam}').',id"
                            : "unique:{$table},{$col}";
                    }

                    // بناء السلسلة النهائية للقواعد
                    $prefix = $isUpdate ? 'sometimes|' . ($nullable ? 'nullable' : 'required') : ($nullable ? 'nullable' : 'required');
                    $rules[$col] = $prefix . '|' . implode('|', $rule);
                }
                return $rules;
            };

            File::put("{$baseFolder}/{$model}StoreRequest.php", self::generateStub("{$model}StoreRequest", $generateRules(false), "Admin\\{$model}"));
            File::put("{$baseFolder}/{$model}UpdateRequest.php", self::generateStub("{$model}UpdateRequest", $generateRules(true), "Admin\\{$model}"));

            return "✅ [Request Success] Store and Update requests generated correctly (Media handled as files)!";
        } catch (\Throwable $e) {
            return "❌ Error: " . $e->getMessage();
        }
    }

    private static function generateStub($className, $rules, $namespace)
    {
        $rulesString = "";
        $messagesString = "";

        foreach ($rules as $key => $rule) {
            $rulesString .= "            '{$key}' => '{$rule}',\n";

            $rulesArray = explode('|', $rule);
            $label = str_replace('_', ' ', $key);

            foreach ($rulesArray as $singleRule) {
                if ($singleRule === 'required') $messagesString .= "            '{$key}.required' => 'The {$label} field is required.',\n";
                if ($singleRule === 'boolean') $messagesString .= "            '{$key}.boolean' => 'The {$label} field must be true or false.',\n";
                if ($singleRule === 'image') $messagesString .= "            '{$key}.image' => 'The {$label} must be a valid image file.',\n";
                if (str_contains($singleRule, 'max:')) {
                    $maxVal = str_replace('max:', '', $singleRule);
                    $msg = (str_contains($rule, 'file') || str_contains($rule, 'image')) ? "greater than {$maxVal} KB." : "greater than {$maxVal} characters.";
                    $messagesString .= "            '{$key}.max' => 'The {$label} may not be {$msg}',\n";
                }
                if (str_contains($singleRule, 'exists:')) $messagesString .= "            '{$key}.exists' => 'The selected {$label} is invalid.',\n";
                if (str_contains($singleRule, 'unique:')) $messagesString .= "            '{$key}.unique' => 'This {$label} has already been taken.',\n";
                if ($singleRule === 'date') $messagesString .= "            '{$key}.date' => 'The {$label} is not a valid date.',\n";
            }
        }

        return "<?php

namespace App\Http\Requests\\{$namespace};

use App\Http\Requests\BaseRequest\BaseRequest;

class {$className} extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
{$rulesString}        ];
    }

    public function messages(): array
    {
        return [
{$messagesString}        ];
    }
}
";
    }
}
