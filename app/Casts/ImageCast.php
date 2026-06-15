<?php
// app/Casts/ImageCast.php
namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ImageCast implements CastsAttributes
{
    // app/Casts/ImageCast.php
    public function get($model, $key, $value, $attributes): ?string
    {
        if (!$value) return null;

        // شيل كل حاجة قبل uploads
        $path = preg_replace('/^.*uploads\//', 'uploads/', $value);

        return asset('storage/' . $path);
    }
    public function set($model, $key, $value, $attributes): ?string
    {
        return $value;
    }
}
