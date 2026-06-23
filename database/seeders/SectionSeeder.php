<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sections')->insert([
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => DB::table('pages')->inRandomOrder()->value('id') ?? 1,
                'type' => 'Sample_' . Str::random(5),
                'order' => 'Sample_' . Str::random(5),
                'props' => 'Sample_' . Str::random(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}