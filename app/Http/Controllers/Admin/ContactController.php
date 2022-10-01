<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contactImages = Contact::first();
        $socials       = SocialMedia::first();
        $instagram     = '';
        $facebook      = '';
        $tiktok        = '';
        $address       = '';
        $maps          = '';

        if(isset($socials)){
            $instagram     = $socials->instagram;
            $facebook      = $socials->facebook;
            $tiktok        = $socials->tiktok;
            $address       = $socials->address;
            $maps          = $socials->maps;
        }

        return view('admin.contact', compact('contactImages', 'instagram', 'facebook', 'tiktok', 'address', 'maps'));
    }

    public function addSocialMedia(Request $request)
    {
        $social = SocialMedia::first();

        if(isset($social)){
            $social->update($request->all());
            $social->maps = str_replace(['width="600"', 'height="450"'], ['width="100%"', 'height="100%"'], $social->maps);
            $social->save();
            return back()->with('success', 'SocialEdited');
        }

        if(!isset($social)){
            SocialMedia::create($request->all());
            $social->maps = str_replace(['width="600"', 'height="450"'], ['width="100%"', 'height="100%"'], $social->maps);
            $social->save();
            return back()->with('success', 'SocialAdded');
        }


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
