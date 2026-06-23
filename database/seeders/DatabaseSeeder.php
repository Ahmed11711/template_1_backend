<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            SettingsSeeder::class,
        ]);
        $this->call(ReviewsSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(SectionSeeder::class);
    
    
    
    }
}
