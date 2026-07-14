<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Smartphones',
                'description' => 'Latest smartphones from top brands like Apple, Samsung, and more.',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800',
                'is_featured' => 1,
                'is_active' => 1,
            ],
            [
                'name' => 'Laptops',
                'description' => 'High performance laptops for work, gaming, and everyday use.',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800',
                'is_featured' => 1,
                'is_active' => 1,
            ],
            [
                'name' => 'Headphones & Earbuds',
                'description' => 'Wireless and wired headphones, earbuds, and noise cancelling audio gear.',
                'image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=800',
                'is_featured' => 1,
                'is_active' => 1,
            ],
            [
                'name' => 'Smart Watches',
                'description' => 'Smartwatches and fitness trackers to keep you connected and healthy.',
                'image' => 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=800',
                'is_featured' => 0,
                'is_active' => 1,
            ],
            [
                'name' => 'Tablets',
                'description' => 'Tablets for productivity, creativity, and entertainment.',
                'image' => 'https://images.unsplash.com/photo-1585790050230-5dd28404ccb9?w=800',
                'is_featured' => 0,
                'is_active' => 1,
            ],
            [
                'name' => 'Cameras',
                'description' => 'Digital cameras, mirrorless, and DSLR gear for photography lovers.',
                'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800',
                'is_featured' => 1,
                'is_active' => 1,
            ],
            [
                'name' => 'TVs & Home Theater',
                'description' => 'Smart TVs, soundbars, and home theater systems.',
                'image' => 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?w=800',
                'is_featured' => 0,
                'is_active' => 1,
            ],
            [
                'name' => 'Speakers',
                'description' => 'Portable and home Bluetooth speakers for every occasion.',
                'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800',
                'is_featured' => 0,
                'is_active' => 1,
            ],
            [
                'name' => 'Gaming',
                'description' => 'Gaming consoles, controllers, and accessories.',
                'image' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800',
                'is_featured' => 1,
                'is_active' => 1,
            ],
            [
                'name' => 'Accessories',
                'description' => 'Chargers, cables, cases, and other electronics accessories.',
                'image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=800',
                'is_featured' => 0,
                'is_active' => 0,
            ],
        ];

        $rows = [];

        foreach ($categories as $i => $cat) {
            $rows[] = [
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'is_featured' => $cat['is_featured'],
                'image' => $cat['image'],
                'sort_order' => $i,
                'is_active' => $cat['is_active'],
                'meta_title' => $cat['name'],
                'meta_description' => $cat['description'],
                'promotional_text' => 'Shop the best deals on ' . $cat['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categories')->insert($rows);
    }
}
