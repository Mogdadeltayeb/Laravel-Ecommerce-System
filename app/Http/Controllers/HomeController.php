<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // جلب الأقسام الرئيسية فقط والفرعيات جاهزة
        $categories = Category::where('show_in_home', true)
                              ->where('is_active', true)
                              ->orderBy('sort_order')
                              ->with('children') // لجلب الأقسام الفرعية
                              ->get();

        return view('home', compact('categories'));
    }
}
