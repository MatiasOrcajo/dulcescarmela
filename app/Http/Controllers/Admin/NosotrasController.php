<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\{Home_Slider, Nosotra, Category, Constants, Product, ProductImage};

class NosotrasController extends Controller
{
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
                "text"   => $request->texto,
                "image"  => $url,
            ]);

            return redirect()->back();
        }

        $nosotras         = new Nosotra;
        $nosotras->text   = $request->texto;

        $nosotras->save();

        return redirect()->back();
    }

    public function deleteNosotrasImage(Request $request)
    {
        $id = $request->get('id');
        $image = Nosotra::where('id', $id)->delete();

        return false;
    }
}
