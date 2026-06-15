<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HomeSectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('home_sections')->insert([
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Str::title('title') . '_' . Str::random(5),
                'color' => 'Sample_' . Str::random(5),
                'sort_order' => 'Sample_' . Str::random(5),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}