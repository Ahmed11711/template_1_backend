<?php

namespace App\Services\command;

use Illuminate\Support\Facades\File;

class RepositoryGenerator
{
    public static function generate(string $model, ?string $module = null)
    {
        if ($module) {
            $repositoryDir = base_path("Modules/{$module}/app/Repositories/{$model}");
            $namespaceBase = "Modules\\{$module}\\Repositories\\{$model}";
            $modelNamespace = "Modules\\{$module}\\Models\\{$model}";
        } else {
            $repositoryDir = app_path("Repositories/{$model}");
            $namespaceBase = "App\\Repositories\\{$model}";
            $modelNamespace = "App\\Models\\{$model}";
        }

        $baseRepository = "App\\Repositories\\BaseRepository\\BaseRepository";
        $baseRepositoryInterface = "App\\Repositories\\BaseRepository\\BaseRepositoryInterface";

        $repositoryPath = $repositoryDir . "/{$model}Repository.php";
        $interfacePath  = $repositoryDir . "/{$model}RepositoryInterface.php";

        if (!File::isDirectory($repositoryDir)) {
            File::makeDirectory($repositoryDir, 0755, true);
        }

        $replaceData = [
            '{{namespaceBase}}'           => $namespaceBase,
            '{{model}}'                   => $model,
            '{{modelNamespace}}'          => $modelNamespace,
            '{{baseRepository}}'          => $baseRepository,
            '{{baseRepositoryInterface}}' => $baseRepositoryInterface,
        ];

        if (!File::exists($repositoryPath)) {
            $template = self::getStub('repository');
            $content  = str_replace(array_keys($replaceData), array_values($replaceData), $template);
            File::put($repositoryPath, $content);
        }

        if (!File::exists($interfacePath)) {
            $template = self::getStub('interface');
            $content  = str_replace(array_keys($replaceData), array_values($replaceData), $template);
            File::put($interfacePath, $content);
        }

        return "✅ {$model}Repository and Interface created successfully!";
    }

    /**
     */
    private static function getStub($type)
    {
        $path = resource_path("stubs/crud/{$type}.stub");

        if (!File::exists($path)) {
            throw new \Exception("Stub file not found at: {$path}");
        }

        return File::get($path);
    }
}
