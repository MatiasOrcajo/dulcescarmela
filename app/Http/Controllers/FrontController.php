<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Home_Slider, Nosotra, Category, Constants, Product, ProductImage, Opinion, OpinionBackground, Counter};

class FrontController extends Controller
{
    public function index()
    {
        // sliders
        $sliders = Home_Slider::orderBy('orden')->get();

        // nosotras
        $nosotras = Nosotra::where('active', 'Si')->first();

        // productos destacados
        $featured = Product::where('featured', 'si')->get();

        // opiniones
        $opinions = Opinion::all();
        $background = OpinionBackground::first();

        // contadores
        $counters = Counter::orderBy('created_at')->get();

        return view('front.index', compact('sliders', 'nosotras', 'featured', 'opinions', 'background', 'counters'));
    }
}


