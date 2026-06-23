<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 0,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 1,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 2,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 3,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 4,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 5,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 6,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 7,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 8,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'slug' => 'slug-' . Str::lower(Str::random(6)) . '-' . 9,
                'status' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}