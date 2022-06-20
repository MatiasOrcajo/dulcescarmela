<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Opinion;
use Illuminate\Support\Facades\Validator;

class OpinionsController extends Controller
{
    public function opinions()
    {

        $opinions = Opinion::all();

        return view('admin.opinions', compact('opinions'));
    }

    public function addOpinion(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'    => 'string|required',
            'content' => 'required',
            'image'   => 'required|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $image = $request->file('image')->store('public/images');
        $url   = Storage::url($image);

        $opinion = Opinion::create([
            'name'    => $request->name,
            'content' => $request->content,
            'image'   => $url,
            'order'   => $request->order
        ]);

        return redirect()->back()->with('success', 'added');
    }

    public function editOpinion(Opinion $opinion, Request $request)
    {
        if($request->file('image')){
            $image = $request->file('image')->store('public/images');
            $url   = Storage::url($image);
        }
        else
        {
            $url = $opinion->image;
        }

        $opinion->update([
            'name'    => $request->name,
            'order'   => $request->order,
            'content' => $request->content,
            'image'   => $url
        ]);

        return redirect()->back()->with('success', 'edited');
    }

    public function deleteOpinion(Opinion $opinion)
    {
        $opinion->delete();
        
        return redirect()->back()->with('success', 'deleted');
    }


}
