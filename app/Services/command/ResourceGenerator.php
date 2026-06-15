<?php

namespace App\Services\command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ResourceGenerator
{
    /**
     * الميثود الرئيسية لإنشاء الموديول وتحديث الموديل
     */
    public static function make(string $model)
    {
        // تحويل اسم الموديل لاسم الجدول (مثلاً Blog -> blogs)
        $modelClass = "App\\Models\\{$model}";

        if (!class_exists($modelClass)) {
            return "❌ Model {$model} does not exist!";
        }

        $table = (new $modelClass)->getTable();

        // جلب أعمدة الجدول
        $columns = Schema::getColumnListing($table);

        // 1. تحديث الموديل بالخصائص الذكية (Searchable, Filterable, Allowed)
        self::updateModel($model, $table, $columns);

        // 2. إنشاء المجلد الخاص بالـ Resources إذا لم يكن موجوداً
        $baseFolder = app_path("Http/Resources/Admin/{$model}");
        if (!File::exists($baseFolder)) {
            File::makeDirectory($baseFolder, 0755, true);
        }

        // 3. توليد ملف الـ Resource (Clean Version بدون Swagger)
        $resourcePath = "{$baseFolder}/{$model}Resource.php";
        File::put($resourcePath, self::generateResourceStub($model, $columns));

        // 4. توليد ملف الـ JS للفرونت إند
        $jsFolder = resource_path("js/forms");
        if (!File::exists($jsFolder)) {
            File::makeDirectory($jsFolder, 0755, true);
        }
        $fieldsPath = "{$jsFolder}/{$model}Fields.js";
        File::put($fieldsPath, self::generateFieldsStub($model, $table, $columns));

        return "✅ [Success] {$model} Model updated with Smart Arrays & Resource generated!";
    }

    /**
     * تحديث الموديل وإضافة مصفوفات الفلترة والبحث أوتوماتيكياً
     */
    private static function updateModel($model, $table, $columns)
    {
        $modelPath = app_path("Models/{$model}.php");
        if (!File::exists($modelPath)) return;

        $content = File::get($modelPath);

        // تحديد الحقول الحساسة التي لا يجب أن تظهر في الـ API
        $skipFields = ['password', 'remember_token', 'deleted_at'];

        // 1. Allowed Fields: كل الأعمدة ما عدا الحساسة
        $allowed = array_values(array_diff($columns, $skipFields));
        $allowedStr = "['" . implode("', '", $allowed) . "']";

        // 2. Searchable: الأعمدة النصية فقط (string/text)
        $searchable = [];
        // 3. Filterable: الأعمدة المعرفة كـ ID أو Boolean أو Enum
        $filterable = [];

        foreach ($columns as $col) {
            $type = Schema::getColumnType($table, $col);

            // منطق تحديد الـ Searchable
            if (in_array($type, ['string', 'text']) && !Str::endsWith($col, '_id') && !in_array($col, ['id', 'image', 'file', 'photo'])) {
                $searchable[] = $col;
            }

            // منطق تحديد الـ Filterable
            if (Str::endsWith($col, '_id') || in_array($type, ['boolean', 'integer', 'enum', 'tinyint'])) {
                if ($col !== 'id') $filterable[] = $col;
            }
        }

        $searchableStr = "['" . implode("', '", $searchable) . "']";
        $filterableStr = "['" . implode("', '", $filterable) . "']";

        // الكود اللي هيتحقن جوه الموديل
        $propertiesStub = "
    public array \$searchable = {$searchableStr};
    public array \$filterable = {$filterableStr};
    public array \$allowedFields = {$allowedStr};
";

        // إذا كانت الخصائص مش موجودة، ضيفها بعد فتح الكلاس
        if (!Str::contains($content, 'public array $allowedFields')) {
            $content = preg_replace('/class ' . $model . '.*?{/s', "$0\n{$propertiesStub}", $content);
        } else {
            // تحديث القيم إذا كانت موجودة مسبقاً
            $content = preg_replace('/public array \$searchable\s*=\s*\[.*?\];/s', "public array \$searchable = {$searchableStr};", $content);
            $content = preg_replace('/public array \$filterable\s*=\s*\[.*?\];/s', "public array \$filterable = {$filterableStr};", $content);
            $content = preg_replace('/public array \$allowedFields\s*=\s*\[.*?\];/s', "public array \$allowedFields = {$allowedStr};", $content);
        }

        // إضافة العلاقات تلقائياً (BelongsTo)
        foreach ($columns as $col) {
            if (Str::endsWith($col, '_id')) {
                $relationName = Str::camel(Str::replaceLast('_id', '', $col));
                if (!Str::contains($content, "function {$relationName}(")) {
                    $relatedModel = Str::studly(Str::replaceLast('_id', '', $col));
                    $relationCode = "\n    public function {$relationName}()\n    {\n        return \$this->belongsTo({$relatedModel}::class, '{$col}');\n    }\n";
                    $content = preg_replace('/}\s*$/', $relationCode . "\n}", $content);
                }
            }
        }

        File::put($modelPath, $content);
    }

    /**
     * توليد ملف الـ Resource
     */
    private static function generateResourceStub($model, $columns)
    {
        $fieldsList = array_diff($columns, ['id', 'password', 'deleted_at']);

        // تحديد حقول الصور
        $imageFields = array_filter(
            $fieldsList,
            fn($col) =>
            preg_match('/(image|img|file|photo|logo|attachment)/i', $col)
        );

        // باقي الحقول العادية
        $normalFields = array_diff($fieldsList, $imageFields);

        $fieldsString = "'" . implode("', '", $normalFields) . "'";

        // بناء كود الصور
        $imageCode = "";
        foreach ($imageFields as $imgField) {
            $imageCode .= "\n        \$data['{$imgField}'] = \$this->{$imgField} ? asset(\$this->{$imgField}) : null;";
        }

        return "<?php

namespace App\Http\Resources\Admin\\{$model};

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\\{$model}
 */
class {$model}Resource extends JsonResource
{
    public function toArray(\$request): array
    {
        \$attributes = \$this->resource->getAttributes();
        \$data = ['id' => \$this->id];
        \$fields = [{$fieldsString}];

        foreach (\$fields as \$field) {
            if (array_key_exists(\$field, \$attributes)) {
                \$data[\$field] = \$this->{\$field};
            }
        }{$imageCode}

        return \$data;
    }
}";
    }
    /**
     * توليد ملف الـ JS للفرونت إند بناءً على قواعد البيانات
     */ private static function generateFieldsStub($model, $table, $columns)
    {
        $modelClass = "App\\Models\\{$model}";

        // التأكد من وجود الموديل لتجنب الأخطاء
        if (!class_exists($modelClass)) {
            return "[]";
        }

        $modelInstance = new $modelClass;

        // جلب الإعدادات من الموديل (إن وجدت)
        $searchable = property_exists($modelInstance, 'searchable') ? $modelInstance->searchable : [];
        $filterable = property_exists($modelInstance, 'filterable') ? $modelInstance->filterable : [];
        $allowedFields = property_exists($modelInstance, 'allowedFields') ? $modelInstance->allowedFields : $columns;

        $fieldsArray = [];

        foreach ($columns as $col) {
            // 1. تخطي الحقول الحساسة
            if (!in_array($col, $allowedFields) || in_array($col, ['password', 'deleted_at', 'remember_token'])) continue;

            $type = Schema::getColumnType($table, $col);
            $inputType = 'text';
            $cellType = 'text';
            $options = "null";
            $displayField = "null";
            $extraFields = ""; // لتخزين الـ endpoint والـ relation_fields

            // --- 2. المنطق الذكي لتحديد الأنواع والعلاقات ---

            // أ- معالجة الصور والمفات
            if (preg_match('/(image|img|file|photo|logo|attachment)/i', $col)) {
                $inputType = 'file';
                $cellType = 'image';
            }
            // ب- معالجة القيم المنطقية (Boolean)
            elseif ($type === 'boolean' || $type === 'tinyint') {
                $inputType = 'checkbox';
                $cellType = 'badge';
                $options = "[{ label: 'Active', value: 1, color: 'success' }, { label: 'Inactive', value: 0, color: 'danger' }]";
            }
            // ج- معالجة العلاقات (Foreign Keys) - الأولوية لعلاقات الموديل
            elseif (Str::endsWith($col, '_id')) {
                $inputType = 'select';
                $cellType = 'relation';

                // استخراج اسم العلاقة (مثلاً user_id -> user)
                $relationName = Str::camel(Str::replaceLast('_id', '', $col));
                $endpoint = Str::plural(Str::snake($relationName)); // تخمين افتراضي (Fall-back)

                // محاولة الوصول للموديل المرتبط عبر العلاقة
                if (method_exists($modelInstance, $relationName)) {
                    try {
                        $relation = $modelInstance->$relationName();
                        // نأخذ اسم الجدول من الموديل المرتبط (هذا هو الـ Endpoint الحقيقي)
                        $endpoint = $relation->getRelated()->getTable();
                        $displayField = "\"{$relationName}.name\"";
                    } catch (\Exception $e) {
                        Log::warning("Could not resolve relation {$relationName} for model {$model}");
                    }
                } else {
                    $displayField = "\"{$relationName}.name\"";
                }

                $options = "{ label: 'name', value: 'id' }";
                $extraFields = "\n    endpoint: '{$endpoint}',\n    relation_fields: 'id,name',";
            }
            // د- معالجة القوائم المنسدلة (Enums)
            elseif ($type === 'enum') {
                $inputType = 'select';
                $cellType = 'badge';
                $enumOptions = DB::selectOne("SHOW COLUMNS FROM {$table} WHERE Field = ?", [$col])->Type;
                preg_match('/^enum\((.*)\)$/', $enumOptions, $matches);
                $values = explode(',', $matches[1]);

                $formattedOptions = array_map(function ($v) {
                    $cleanVal = trim($v, "'");
                    $label = Str::title($cleanVal);
                    return "{ label: \"{$label}\", value: '{$cleanVal}' }";
                }, $values);

                $options = "[" . implode(', ', $formattedOptions) . "]";
            }
            // هـ- التواريخ والأرقام
            elseif (in_array($type, ['date', 'datetime', 'timestamp'])) {
                $inputType = 'date';
                $cellType = 'date';
            } elseif (in_array($type, ['decimal', 'float', 'double', 'integer', 'bigint'])) {
                $inputType = 'text'; // أو 'number' حسب تفضيل الفرونت
                $cellType = 'text';
            }

            // --- 3. الإعدادات العامة (Table & Form Visibility) ---

            $columnInfo = DB::selectOne("SELECT IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND COLUMN_NAME = ? AND TABLE_SCHEMA = DATABASE()", [$table, $col]);
            $required = ($columnInfo && $columnInfo->IS_NULLABLE === 'NO') ? 1 : 0;
            $label = Str::title(str_replace('_', ' ', $col));

            // منطق الفرونت إند في العرض (Table Show)
            $isLongText = in_array($type, ['text', 'longtext']);
            $isRelation = Str::endsWith($col, '_id');
            $isDate = in_array($type, ['date', 'datetime', 'timestamp']);

            // افتراضياً: لا تظهر الـ IDs ولا العلاقات ولا النصوص الطويلة ولا أغلب التواريخ في الجدول
            $tableShow = 'false';

            // حقول استثنائية تظهر دائماً في الجدول حسب طلب الفرونت إند
            $alwaysShowInTable = ['status', 'price', 'image', 'active', 'title_ar', 'created_at'];
            if (in_array($col, $alwaysShowInTable) || (!$isLongText && !$isRelation && !$isDate && $col !== 'id')) {
                $tableShow = 'true';
            }

            $isSortable = (!$isLongText) ? 'true' : 'false';
            $formShow = (in_array($col, ['created_at', 'updated_at'])) ? 'false' : 'true';

            // بناء الكود النهائي للحقل
            $fieldsArray[] = "  { 
    key: \"{$col}\", 
    label: \"{$label}\", 
    type: \"{$inputType}\", 
    cell_type: \"{$cellType}\",
    display_field: {$displayField},
    required: {$required}, 
    placeholder: \"Enter {$label}\",
    searchable: " . (in_array($col, $searchable) ? 'true' : 'false') . ",
    filterable: " . (in_array($col, $filterable) ? 'true' : 'false') . ",
    sortable: {$isSortable},
    table_show: {$tableShow},
    form_show: {$formShow},{$extraFields}
    options: {$options}
  }";
        }

        $fieldsString = implode(",\n", $fieldsArray);
        $timestamp = date('Y-m-d H:i:s');

        return <<<JS
/**
 * Auto-generated fields for {$model}
 * Generated at: {$timestamp}
 */
export const {$model}Fields = [
{$fieldsString}
];
JS;
    }
}
