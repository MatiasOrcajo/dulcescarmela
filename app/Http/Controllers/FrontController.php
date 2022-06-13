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

        return view('front.index', compact('sliders'));
    }
}
