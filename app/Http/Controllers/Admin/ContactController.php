<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contactImages = Contact::first();

        return view('admin.contact', compact('contactImages'));
    }

    public function addContact(StoreContactRequest $request)
    {
        $validated = $request->validated();

        if($validated['image_1']){
            $image       = $request->file('image_1')->store('public/images');
            $image_1_url = Storage::url($image);
        }
        if($validated['image_2']){
            $image       = $request->file('image_2')->store('public/images');
            $image_2_url = Storage::url($image);
        }

        Contact::create([
            'image_1' => $image_1_url,
            'image_2' => $image_2_url
        ]);

        return back();
    }

    public function editContact(StoreContactRequest $request)
    {
        $contact = Contact::first();
        $validated = $request->validated();

        if(isset($validated['image_1'])){
            $image       = $request->file('image_1')->store('public/images');
            $image_1_url = Storage::url($image);

            $contact->image_1 = $image_1_url;
            $contact->save();
        }

        if(isset($validated['image_2'])){
            $image       = $request->file('image_2')->store('public/images');
            $image_2_url = Storage::url($image);

            $contact->image_2 = $image_2_url;
            $contact->save();
        }

        return back()->with('success', 'edited');
    }
}
