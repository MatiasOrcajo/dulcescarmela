<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Home_Slider, Nosotra, Category, Constants, Product, ProductImage, Opinion, OpinionBackground, Counter, Contact, WhatsApp};

class FrontController extends Controller
{
    public function index()
    {
        // sliders
        $sliders = Home_Slider::orderBy('orden')->get();

        // nosotras
        $nosotras = Nosotra::first();

        // productos destacados
        $featured = Product::where('featured', 'si')->get();

        // opiniones
        $opinions = Opinion::all();
        $background = OpinionBackground::first();

        // contadores
        $counters = Counter::orderBy('created_at')->get();

        // contacto
        $contact = Contact::first();

        // whatsapp

        $whatsapp = WhatsApp::first();

        return view('front.index', compact('sliders', 'nosotras', 'featured', 'opinions', 'background', 'counters', 'contact', 'whatsapp'));
    }

    // vista individual de producto

    public function showProduct($slug)
    {
        $whatsapp     = WhatsApp::first();
        $product      = Product::where('slug', $slug)->first();
        $whatsappText = $whatsapp->generateText($product->title, $whatsapp->text);

        return view('front.showProduct', compact('product', 'whatsappText'));
    }

}


