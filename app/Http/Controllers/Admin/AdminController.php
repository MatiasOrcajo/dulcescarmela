<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use App\Models\{Home_Slider};

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    
    
    public function homeSlider()
    {
        
        $sliders = Home_Slider::orderBy('order', 'ASC')->get();

        return view('admin.homeSlider', compact('sliders'));
    }

    
    
    public function subirSlider(Request $request)
    {
        $imagen = $request->file('imagen')->store('public/images');
        $url = Storage::url($imagen);

        $home_slider = new Home_Slider;

        $home_slider->image = $url;
        $home_slider->text = $request->texto;
        $home_slider->order = $request->orden;

        $home_slider->save();

        return redirect()->back();
    }

    public function editarSlider (Request $request, Home_Slider $id)
    {
        $slider = Home_Slider::find($id)->first();

        $imagen = $request->file('imagen')->store('public/images');
        $url = Storage::url($imagen);

        $slider->image = $url;
        $slider->text = $request->texto;
        $slider->order = $request->orden;

        $slider->save();

        return redirect()->back();
    }

    public function eliminarSlider (Home_Slider $id)
    {
        $slider = Home_Slider::find($id)->first();

        $slider->delete();

        return redirect()->back();
    }
}
