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

        return view('admin.homeSlider', compact('sliders'));
    }

    
    
    public function addSlider(Request $request)
    {
        $imagen = $request->file('imagen')->store('public/images');
        $url = Storage::url($imagen);

        $home_slider = new Home_Slider;

        $home_slider->image = $url;
        $home_slider->text  = $request->texto;
        $home_slider->order = $request->orden;

        $home_slider->save();

        return redirect()->back();
    }

    public function editSlider (Request $request, Home_Slider $slider)
    {
        $imagen = $request->file('imagen')->store('public/images');
        $url = Storage::url($imagen);

        $slider->image = $url;
        $slider->text  = $request->texto;
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
                "text"   => $request->texto,
                "active" => $request->active,
                "image"  => $request->has('imagen') ? $url : $imagen->image
            ]);

            return redirect()->back();
        }

        $image = $request->file('imagen')->store('public/images');
        $url = Storage::url($image);

        $nosotras         = new Nosotra;
        $nosotras->image  = $url;
        $nosotras->text   = $request->texto;
        $nosotras->active = $request->active;

        $nosotras->save();
        
        return redirect()->back();
    }

    public function deleteNosotrasImage(Request $request)
    {
        $id = $request->get('id');

        $image = Nosotra::where('id', $id)->delete();
        
        return false;
    }

    public function categories()
    {
        $categories = Category::all();

        return view('admin.categories', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        if($request->has('edit'))
        {   
            if($request->file('image'))
            {
                $image = $request->file('image')->store('public/images');
                $url   = Storage::url($image);
            }
            $category  = Category::where('id', $request->get('id'))->first();
            $category->update([
                'name'    => $request->get('name'),
                'order'   => $request->get('order'),
                'visible' => $request->get('visible') == Constants::CATEGORY_IS_VISIBLE ? Constants::CATEGORY_IS_VISIBLE : Constants::CATEGORY_ISNT_VISIBLE,
                'image'   => $request->file('image') ? $url : $category->image,
                'slug'    => Str::slug($request->get('name'))
            ]);

            return;
        }

        $image = $request->file('image')->store('public/images');
        $url   = Storage::url($image);

        $category = new Category;

        $category->name    = $request->get('name');
        $category->order   = $request->get('order');
        $category->visible = $request->get('visible') == Constants::CATEGORY_IS_VISIBLE ? Constants::CATEGORY_IS_VISIBLE : Constants::CATEGORY_ISNT_VISIBLE;
        $category->image   = $url;
        $category->slug    = $category->generateSlug();

        $category->save();

        return;
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::where('id', $request->get('id'))->delete();

        return false;
    }

    public function getCategory(Request $request)
    {
        $category = Category::where('id', $request->get('id'))->first();
        $object   = ["category" => $category];

        return response()->json($object);
    }

    public function showCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();

        return view('admin.showCategory', compact('category'));
    }

    public function createProduct(Request $request, $slug)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'price'       => 'required',
        ]);

        if($request->file('cover_photo')){
            $cover_photo_to_store = $request->file('cover_photo')->store('public/images');
            $cover_photo_url      = Storage::url($cover_photo_to_store);
        }
        
        $category = Category::where('slug', $slug)->first();
        $product = Product::create([
            'category_id'    => $category->id,
            'title'          => $request->title,
            'slug'           => Str::slug($request->title),
            'description'    => $request->description,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'cover_photo'    => $request->file('cover_photo') ? $cover_photo_url : ''
        ]);

        foreach($request->file('images') as $image){
            $imageToStore = $image->store('public/images');
            $url          = Storage::url($imageToStore);

            ProductImage::create([
                'image'      => $url,
                'product_id' => $product->id
            ]);
        }

        return back()->with('success', 'Added');

    }

    public function showProduct($slug)
    {
        $product    = Product::where('slug', $slug)->first();
        $categories = Category::all();

        return view('admin.showProduct', compact('product', 'categories'));
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Deleted');
    }

    public function editProduct(Request $request, Product $product)
    {
        if($request->file('cover_photo')){
            $cover_photo_to_store = $request->file('cover_photo')->store('public/images');
            $cover_photo_url      = Storage::url($cover_photo_to_store);
        }

        $currentCoverPhoto = $product->cover_photo;
        
        $product->update([
            'category'       => $request->get('category'),
            'title'          => $request->get('title'),
            'description'    => $request->get('description'),
            'price'          => $request->get('price'),
            'discount_price' => $request->get('discount_price'),
            'cover_photo'    => $request->file('cover_photo') ? $cover_photo_url : $currentCoverPhoto,
        ]);

        return back()->with('success', 'Edited');
    }

    public function editProductImages(Product $product)
    {
        return view('admin.showProductImages', compact('product'));
    }

    public function editProductImage(Request $request)
    {
        $product_image = ProductImage::where('id', $request->get('id'))->first();

        if($request->file('image')){
            $new_image_to_store = $request->file('image')->store('public/images');
            $new_image_url      = Storage::url($new_image_to_store);
        }

        if(File::exists(public_path($product_image->image))){
            File::delete(public_path($product_image->image));
        }

        $product_image->update([
            'image' => $new_image_url,
        ]);

        return back();
    }

    public function deleteProductImage(Request $request)
    {
        $product_image = ProductImage::where('id', $request->get('id'))->first();

        if(File::exists(public_path($product_image->image))){
            File::delete(public_path($product_image->image));
        }

        $product_image->delete();

        return back();
    }

    public function addProductImage(Request $request)
    {
        if($request->file('image')){
            $new_image_to_store = $request->file('image')->store('public/images');
            $new_image_url      = Storage::url($new_image_to_store);
        }

        ProductImage::create([
            'image' => $new_image_url,
            'product_id' => $request->get('id')
        ]);

        return back();
    }
}
