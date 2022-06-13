<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\{Home_Slider, Nosotra, Category, Constants, Product, ProductImage};

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    
    
    public function homeSlider()
    {
        
        $sliders = Home_Slider::orderBy('orden', 'ASC')->get();
        $products = Product::all();

        return view('admin.homeSlider', compact('sliders', 'products'));
    }

    
    
    public function addSlider(Request $request)
    {
        $imagen = $request->file('imagen')->store('public/images');
        $url = Storage::url($imagen);

        $home_slider = new Home_Slider;

        $home_slider->image = $url;
        $home_slider->texto  = $request->texto;
        $home_slider->orden = $request->orden;
        $home_slider->product_id = $request->product;

        $home_slider->save();

        return redirect()->back();
    }

    public function editSlider (Request $request, Home_Slider $slider)
    {
        if($request->file('imagen')){
            $imagen = $request->file('imagen')->store('public/images');
            $url = Storage::url($imagen);
            $slider->image = $url;
        }

        
        $slider->texto  = $request->texto;
        $slider->orden = $request->orden;
        $slider->product_id = $request->product;

        $slider->save();

        return redirect()->back();
    }

    public function deleteSlider (Home_Slider $slider)
    {
        $slider->delete();

        return redirect()->back();
    }
   
}
