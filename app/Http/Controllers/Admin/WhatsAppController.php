<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\WhatsApp;
use Illuminate\Support\Facades\Validator;

class WhatsAppController extends Controller
{
    public function whatsapp()
    {
        $whatsapp = WhatsApp::first();

        return view('admin.whatsapp', compact('whatsapp'));
    }

    public function addWhatsApp(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'number' => 'numeric|required',
            'text'   => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $whatsapp = WhatsApp::create([
            'number' => $request->number,
            'text'   => $request->text
        ]);

        return redirect()->back()->with('success', 'added');
    }

    public function editWhatsApp(WhatsApp $whatsapp, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'number' => 'numeric|required',
            'text'   => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $whatsapp->update([
            'number' => $request->number,
            'text'   => $request->text
        ]);

        return redirect()->back()->with('success', 'edited');
    }
}
