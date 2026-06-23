<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key'         => 'require_login_to_comment',
                'value'       => 'true',
                'type'        => 'boolean',
                'label'       => 'Require Login to Add a Comment',
            ],
            [
                'key'         => 'show_comments_on_products',
                'value'       => 'true',
                'type'        => 'boolean',
                'label'       => 'Show Comments on Product Pages',
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],   // match condition (no duplicates)
                array_merge($setting, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
