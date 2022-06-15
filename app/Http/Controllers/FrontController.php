<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Home_Slider, Nosotra, Category, Constants, Product, ProductImage};

class FrontController extends Controller
{
    public function index()
    {
        // sliders
        $sliders = Home_Slider::all();

        // nosotras
        $nosotras = Nosotra::where('active', 'Si')->first();

        // productos destacados
        $featured = Product::where('featured', 'si')->get();
        

        return view('front.index', compact('sliders', 'nosotras', 'featured'));
    }
}


