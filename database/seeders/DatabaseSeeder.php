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
        $this->call(UserSeeder::class);

        $this->call(GovernorateSeeder::class);
        $this->call(StationSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(UserDepositeSeeder::class);
        $this->call(UserOrderSeeder::class);
        $this->call(AdsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(HomeSectionSeeder::class);
    
    
    
    
    
    
    
    }
}
