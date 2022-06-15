<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['title', 'slug', 'description', 'specs', 'price', 'images', 'cover_photo', 'category_id', 'has_discount', 'discount_price', 'featured'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getProductImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
