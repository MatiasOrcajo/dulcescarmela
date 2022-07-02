<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\Http\Requests\StoreCounterRequest;

class CountersController extends Controller
{
    public function index()
    {
        $counters = Counter::all();

        return view('admin.counters', compact('counters'));
    }

    public function addCounter(StoreCounterRequest $request)
    {
        $validated = $request->validated();

        if($validated['icon']){
            $icon    = $request->file('icon')->store('public/images');
            $iconUrl = Storage::url($icon);
        }

        Counter::create([
            'title'    => $validated['title'],
            'quantity' => $validated['quantity'],
            'icon'     => $iconUrl
        ]);

        return redirect()->back()->with('success', 'added');
    }

    public function editCounter(StoreCounterRequest $request, Counter $counter)
    {
        $validated = $request->validated();

        if($request->file('icon')){
            $icon    = $request->file('icon')->store('public/images');
            $iconUrl = Storage::url($icon);
        }
        else{
            $iconUrl = $counter->icon;
        }

        $counter->update([
            'title'    => $validated['title'],
            'quantity' => $validated['quantity'],
            'icon'     => $iconUrl
        ]);

        return back()->with('success', 'edited');
    }

    public function deleteCounter(counter $counter)
    {
        $counter->delete();

        return back()->with('success', 'deleted');
    }
}
