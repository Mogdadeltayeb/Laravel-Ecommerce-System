<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'image_alt',
        'parent_id',
        'show_in_home',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description'
    ];

    // علاقة القسم الأب
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // علاقة الأقسام الفرعية
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
{
    return $this->hasMany(Product::class);
}

}
