<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\{Home_Slider, Nosotra, Category, Constants, Product, ProductImage};

class ProductController extends Controller
{
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
            // 'discount_price' => $request->get('discount_price'),
            'cover_photo'    => $request->file('cover_photo') ? $cover_photo_url : $currentCoverPhoto,
            'featured'       => $request->get('featured'),
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
