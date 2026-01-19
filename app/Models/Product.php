<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'sale_price',
        'category_id', 'quantity', 'is_active', 'image',
        'image_alt', 'meta_title', 'meta_description', 'sort_order'
    ];

    // علاقة المنتج بالقسم
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
