<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentGatewaySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_gateways')->insert([
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 1,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 1,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 0,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 0,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 1,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => Str::title('name') . '_' . Str::random(5),
                'image' => collect(['https://images.unsplash.com/photo-1498050108023-c5249f4df085','https://images.unsplash.com/photo-1461747823400-487cf1852d7e','https://images.unsplash.com/photo-1504639725590-34d0984388bd'])->random(),
                'value' => 'Sample_' . Str::random(5),
                'requires_receipt' => 0,
                'is_active' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}