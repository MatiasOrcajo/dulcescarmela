<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home_Slider extends Model
{
    protected $table = "home_sliders";
    protected $fillable = ["texto", "orden", "product_id", "image"];

    

    use HasFactory;
}
