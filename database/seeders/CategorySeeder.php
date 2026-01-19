<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // أقسام رئيسية
        $categories = [
            [
                'name' => 'Electronics',
                'image' => 'categories/electronics.jpg',
                'show_in_home' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Fashion',
                'image' => 'categories/fashion.jpg',
                'show_in_home' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Home & Kitchen',
                'image' => 'categories/home_kitchen.jpg',
                'show_in_home' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'image' => $cat['image'],
                'image_alt' => $cat['name'],
                'show_in_home' => $cat['show_in_home'],
                'is_active' => $cat['is_active'],
                'sort_order' => $cat['sort_order'],
            ]);
        }

        // أقسام فرعية (مثال)
        $electronics = Category::where('slug', 'electronics')->first();

        $subCategories = [
            [
                'name' => 'Mobile Phones',
                'parent_id' => $electronics->id,
                'show_in_home' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Laptops',
                'parent_id' => $electronics->id,
                'show_in_home' => false,
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($subCategories as $sub) {
            Category::create([
                'name' => $sub['name'],
                'slug' => Str::slug($sub['name']),
                'parent_id' => $sub['parent_id'],
                'show_in_home' => $sub['show_in_home'],
                'is_active' => $sub['is_active'],
                'sort_order' => $sub['sort_order'],
            ]);
        }
    }
}
