<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\{Home_Slider, Nosotra, Category, Constants, Product, ProductImage};

class CategoryController extends Controller
{
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

}
