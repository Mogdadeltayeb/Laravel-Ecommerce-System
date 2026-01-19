<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // جلب جميع الأقسام الفرعية فقط (parent_id != null)
        $subCategories = Category::whereNotNull('parent_id')->get();

        foreach ($subCategories as $subCategory) {

            // نضيف 5 منتجات لكل قسم فرعي
            for ($i = 1; $i <= 5; $i++) {

                $name = $subCategory->name . ' Product ' . $i;

                Product::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => 'وصف تجريبي للمنتج ' . $i,
                    'price' => rand(100, 1000),          // سعر عشوائي
                    'sale_price' => rand(50, 99),        // سعر تخفيض عشوائي
                    'category_id' => $subCategory->id,   // ربط بالقسم الفرعي
                    'quantity' => rand(1, 50),           // كمية عشوائية
                    'is_active' => true,
                    'image' => 'products/' . $subCategory->slug . '.jpg', // مثال مسار الصورة
                    'image_alt' => $name,
                    'meta_title' => $name,
                    'meta_description' => 'وصف SEO تجريبي للمنتج ' . $i,
                    'sort_order' => $i
                ]);
            }
        }
    }
}
