<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 16 Pro',
                'category_id' => 1,
                'price' => 65000,
                'compare_price' => 68000,
                'cost_price' => 60000,
                'stock_quantity' => 100,
                'description' => 'Apple iPhone 16 Pro',
                'images' => [
                    'https://images.unsplash.com/photo-1591337676887-a217a6970a8a?w=800',
                    'https://images.unsplash.com/photo-1592286927505-1def25115caf?w=800',
                    'https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?w=800',
                ],
                'variants' => [
                    ['sku' => 'IP16-BLK-128', 'color' => 'Black', 'storage' => '128GB', 'price_adjustment' => 0, 'stock' => 20],
                    ['sku' => 'IP16-BLK-256', 'color' => 'Black', 'storage' => '256GB', 'price_adjustment' => 4000, 'stock' => 15],
                    ['sku' => 'IP16-WHT-128', 'color' => 'White', 'storage' => '128GB', 'price_adjustment' => 0, 'stock' => 10],
                ],
            ],
            [
                'name' => 'Samsung S25 Ultra',
                'category_id' => 1,
                'price' => 52000,
                'compare_price' => 55000,
                'cost_price' => 47000,
                'stock_quantity' => 80,
                'description' => 'Samsung Galaxy S25 Ultra',
                'images' => [
                    'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=800',
                    'https://images.unsplash.com/photo-1610792516286-524726503fb2?w=800',
                ],
                'variants' => [
                    ['sku' => 'S25-BLK-256', 'color' => 'Black', 'storage' => '256GB', 'price_adjustment' => 0, 'stock' => 25],
                    ['sku' => 'S25-GRN-512', 'color' => 'Green', 'storage' => '512GB', 'price_adjustment' => 5000, 'stock' => 12],
                ],
            ],
            [
                'name' => 'MacBook Pro 16"',
                'category_id' => 1,
                'price' => 95000,
                'compare_price' => 99000,
                'cost_price' => 88000,
                'stock_quantity' => 40,
                'description' => 'Apple MacBook Pro 16 inch',
                'images' => [
                    'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800',
                    'https://images.unsplash.com/photo-1531297484001-80022131f5a1?w=800',
                ],
                'variants' => [
                    ['sku' => 'MBP16-SLV-512', 'color' => 'Silver', 'storage' => '512GB', 'price_adjustment' => 0, 'stock' => 8],
                    ['sku' => 'MBP16-BLK-1TB', 'color' => 'Space Black', 'storage' => '1TB', 'price_adjustment' => 10000, 'stock' => 5],
                ],
            ],
            [
                'name' => 'Dell XPS 15',
                'category_id' => 1,
                'price' => 68000,
                'compare_price' => 72000,
                'cost_price' => 60000,
                'stock_quantity' => 35,
                'description' => 'Dell XPS 15 Laptop',
                'images' => [
                    'https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?w=800',
                    'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800',
                ],
                'variants' => [
                    ['sku' => 'XPS15-SLV-512', 'color' => 'Silver', 'storage' => '512GB', 'price_adjustment' => 0, 'stock' => 10],
                    ['sku' => 'XPS15-BLK-1TB', 'color' => 'Black', 'storage' => '1TB', 'price_adjustment' => 6000, 'stock' => 6],
                ],
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'category_id' => 1,
                'price' => 8500,
                'compare_price' => 9200,
                'cost_price' => 7000,
                'stock_quantity' => 60,
                'description' => 'Sony Wireless Noise Cancelling Headphones',
                'images' => [
                    'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=800',
                    'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=800',
                ],
                'variants' => [
                    ['sku' => 'SNY-XM5-BLK', 'color' => 'Black', 'storage' => null, 'price_adjustment' => 0, 'stock' => 30],
                    ['sku' => 'SNY-XM5-SLV', 'color' => 'Silver', 'storage' => null, 'price_adjustment' => 0, 'stock' => 20],
                ],
            ],
            [
                'name' => 'Apple Watch Series 10',
                'category_id' => 1,
                'price' => 15500,
                'compare_price' => 16800,
                'cost_price' => 13000,
                'stock_quantity' => 50,
                'description' => 'Apple Watch Series 10 Smartwatch',
                'images' => [
                    'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=800',
                    'https://images.unsplash.com/photo-1551816230-ef5deaed4a26?w=800',
                ],
                'variants' => [
                    ['sku' => 'AWS10-BLK-41', 'color' => 'Black', 'storage' => '41mm', 'price_adjustment' => 0, 'stock' => 20],
                    ['sku' => 'AWS10-SLV-45', 'color' => 'Silver', 'storage' => '45mm', 'price_adjustment' => 1500, 'stock' => 15],
                ],
            ],
            [
                'name' => 'iPad Pro 12.9"',
                'category_id' => 1,
                'price' => 42000,
                'compare_price' => 45000,
                'cost_price' => 37000,
                'stock_quantity' => 45,
                'description' => 'Apple iPad Pro 12.9 inch',
                'images' => [
                    'https://images.unsplash.com/photo-1585790050230-5dd28404ccb9?w=800',
                    'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=800',
                ],
                'variants' => [
                    ['sku' => 'IPADP-SLV-256', 'color' => 'Silver', 'storage' => '256GB', 'price_adjustment' => 0, 'stock' => 18],
                    ['sku' => 'IPADP-SPG-512', 'color' => 'Space Gray', 'storage' => '512GB', 'price_adjustment' => 6000, 'stock' => 10],
                ],
            ],
            [
                'name' => 'Canon EOS R6 Camera',
                'category_id' => 1,
                'price' => 89000,
                'compare_price' => 94000,
                'cost_price' => 80000,
                'stock_quantity' => 20,
                'description' => 'Canon EOS R6 Mirrorless Camera',
                'images' => [
                    'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800',
                    'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=800',
                ],
                'variants' => [
                    ['sku' => 'CNR6-BODY', 'color' => 'Black', 'storage' => null, 'price_adjustment' => 0, 'stock' => 8],
                    ['sku' => 'CNR6-KIT', 'color' => 'Black', 'storage' => null, 'price_adjustment' => 12000, 'stock' => 5],
                ],
            ],
            [
                'name' => 'Samsung 55" QLED TV',
                'category_id' => 1,
                'price' => 34000,
                'compare_price' => 38000,
                'cost_price' => 29000,
                'stock_quantity' => 25,
                'description' => 'Samsung 55 inch QLED Smart TV',
                'images' => [
                    'https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=800',
                    'https://images.unsplash.com/photo-1461151304267-38535e780c79?w=800',
                ],
                'variants' => [
                    ['sku' => 'SMSG-QLED55', 'color' => 'Black', 'storage' => null, 'price_adjustment' => 0, 'stock' => 15],
                ],
            ],
            [
                'name' => 'JBL Charge 5 Speaker',
                'category_id' => 1,
                'price' => 4200,
                'compare_price' => 4800,
                'cost_price' => 3400,
                'stock_quantity' => 100,
                'description' => 'JBL Charge 5 Portable Bluetooth Speaker',
                'images' => [
                    'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800',
                    'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=800',
                ],
                'variants' => [
                    ['sku' => 'JBL-CH5-BLK', 'color' => 'Black', 'storage' => null, 'price_adjustment' => 0, 'stock' => 40],
                    ['sku' => 'JBL-CH5-BLU', 'color' => 'Blue', 'storage' => null, 'price_adjustment' => 0, 'stock' => 30],
                ],
            ],
        ];

        foreach ($products as $item) {

            $product = Product::create([
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'short_description' => $item['description'],
                'description' => $item['description'],
                'sku' => strtoupper(Str::random(10)),
                'price' => $item['price'],
                'compare_price' => $item['compare_price'],
                'cost_price' => $item['cost_price'],
                'track_stock' => true,
                'stock_quantity' => $item['stock_quantity'],
                'low_stock_threshold' => 5,
                'is_active' => true,
                'is_featured' => rand(0, 1),
                'sort_order' => 0,
                'meta_title' => $item['name'],
                'meta_description' => $item['description'],
                'views_count' => rand(50, 500),
                'average_rating' => rand(35, 50) / 10,
                'reviews_count' => rand(5, 120),
            ]);

            foreach ($item['images'] as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image,
                    'is_primary' => $index === 0,
                    'sort_order' => $index + 1,
                ]);
            }

            foreach ($item['variants'] as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $variant['sku'],
                    'color' => $variant['color'],
                    'storage' => $variant['storage'],
                    'size' => null,
                    'price_adjustment' => $variant['price_adjustment'],
                    'stock' => $variant['stock'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
