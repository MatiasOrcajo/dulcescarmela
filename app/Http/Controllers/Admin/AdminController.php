<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

use App\Models\{Home_Slider, Nosotra};

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

    
    
    public function addSlider(Request $request)
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

    public function editSlider (Request $request, Home_Slider $slider)
    {
        $imagen = $request->file('imagen')->store('public/images');
        $url = Storage::url($imagen);

        $slider->image = $url;
        $slider->text = $request->texto;
        $slider->order = $request->orden;

        $slider->save();

        return redirect()->back();
    }

    public function deleteSlider (Home_Slider $slider)
    {
        $slider->delete();

        return redirect()->back();
    }

    public function nosotras()
    {
        $images = Nosotra::all();
        return view('admin.nosotras', compact('images'));
    }

    public function addToNosotras(Request $request)
    {
        if($request->has('edit'))
        {
            $imagen = Nosotra::where('id', $request->edit)->first();

            if($request->hasFile('imagen'))
            {
                $image = $request->file('imagen')->store('public/images');
                $url = Storage::url($image);
            }
            
            $imagen->update([
                "text" => $request->texto,
                "active" => $request->active,
                "image" => $request->has('imagen') ? $url : $imagen->image
            ]);

            return redirect()->back();
        }

        $image = $request->file('imagen')->store('public/images');
        $url = Storage::url($image);

        $nosotras = new Nosotra;
        $nosotras->image = $url;
        $nosotras->text = $request->texto;
        $nosotras->active = $request->active;

        $nosotras->save();
        
        return redirect()->back();
    }

    public function deleteNosotrasImage(Request $request)
    {
        $id = $request->get('id');

        $image = Nosotra::where('id', $id)->delete();
        
        return true;
    }

}
