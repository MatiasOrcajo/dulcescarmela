<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'order', 'visible', 'image', 'slug'];

    public function generateSlug()
    {
        return Str::slug($this->name);
    }

    public function countProducts(): int
    {
        return count($this->products);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
