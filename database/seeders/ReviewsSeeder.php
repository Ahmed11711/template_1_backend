<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 1,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 0,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => DB::table('products')->inRandomOrder()->value('id') ?? 1,
                'user_id' => DB::table('users')->inRandomOrder()->value('id') ?? 1,
                'guest_name' => Str::title('guest_name') . '_' . Str::random(5),
                'rating' => 1,
                'comment' => 'Sample_' . Str::random(5),
                'emoji' => 'Sample_' . Str::random(5),
                'is_approved' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}