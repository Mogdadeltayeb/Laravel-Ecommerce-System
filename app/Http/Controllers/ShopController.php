<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Query أساسي للمنتجات الفعالة
        $query = Product::where('is_active', true);

        $currentCategory = null;

        // فلترة بالقسم (slug أو id)
        if ($request->filled('category')) {

            $currentCategory = Category::where('slug', $request->category)
                ->orWhere('id', $request->category)
                ->firstOrFail();

            // جلب الأقسام الفرعية
            $categoryIds = Category::where('parent_id', $currentCategory->id)
                ->pluck('id')
                ->push($currentCategory->id);

            $query->whereIn('category_id', $categoryIds);
        }

        // ترتيب (اختياري)
        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc'  => $query->orderBy('price', 'asc'),
                'price_desc' => $query->orderBy('price', 'desc'),
                default      => $query->latest(),
            };
        } else {
            $query->latest();
        }

        // Pagination
        $products = $query->paginate(9)->withQueryString();

        // الأقسام للفلترة الجانبية
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('shop', compact(
            'products',
            'categories',
            'currentCategory'
        ));
    }
}
