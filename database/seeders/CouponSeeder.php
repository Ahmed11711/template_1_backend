<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [];

        for ($i = 0; $i < 10; $i++) {
            $type = collect(['percentage', 'fixed'])->random();

            $coupons[] = [
                'code' => strtoupper(Str::random(8)),
                'type' => $type,
                'value' => $type === 'percentage' ? rand(5, 50) : rand(20, 500),
                'min_order_amount' => rand(100, 1000),
                'max_uses' => rand(10, 200),
                'used_count' => rand(0, 10),
                'expires_at' => now()->addDays(rand(7, 90)),
                'is_active' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('coupons')->insert($coupons);
    }
}
