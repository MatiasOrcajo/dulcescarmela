<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// RUTAS DEL ADMIN

Route::group(['middleware' => ['auth']], function() {

        Route::group(['prefix' => 'admin'], function(){

            Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');

            // sliders
            Route::get('/home-slider', 'Admin\AdminController@homeSlider')->name('admin.homeSlider');
            Route::post('/agregar-slider', 'Admin\AdminController@addSlider')->name('admin.subirSlider');
            Route::post('/home-slider/{slider}/editar', 'Admin\AdminController@editSlider')->name('admin.editarSlider');
            Route::delete('/home-slider/{slider}/eliminar', 'Admin\AdminController@deleteSlider')->name('admin.eliminarSlider');

            // nosotras
            Route::get('nosotras', 'Admin\NosotrasController@nosotras')->name('admin.nosotras');
            Route::post('/nosotras/add', 'Admin\NosotrasController@addToNosotras')->name('admin.nosotras.add');
            Route::delete('/nosotras/delete', 'Admin\NosotrasController@deleteNosotrasImage')->name('admin.nosotras.delete');

            // categorias
            Route::get('/categorias', 'Admin\CategoryController@categories')->name('admin.categories');
            Route::post('categorias/create', 'Admin\CategoryController@createCategory')->name('admin.categories.create');
            Route::delete('categorias/delete', 'Admin\CategoryController@deleteCategory')->name('admin.categories.delete');
            Route::get('/categorias/get', 'Admin\CategoryController@getCategory')->name('admin.categories.get');
            Route::get('categoria/{slug}', 'Admin\CategoryController@showCategory')->name('admin.categories.show');
            Route::post('/categoria/{slug}/create-product', 'Admin\CategoryController@createProduct')->name('admin.product.create');

            // productos
            Route::get('producto/{slug}', 'Admin\ProductController@showProduct')->name('admin.product.show');
            Route::delete('producto/{product}', 'Admin\ProductController@deleteProduct')->name('admin.product.delete');
            Route::post('producto/{product}/edit', 'Admin\ProductController@editProduct')->name('admin.product.edit');
            Route::get('producto/{product}/imagenes', 'Admin\ProductController@editProductImages')->name('admin.product.images');

                // editar imagen del producto
                Route::post('producto/edit-image', 'Admin\ProductController@editProductImage')->name('admin.product.editProductImage');

                //borrar imagen del producto
                Route::delete('producto/delete-image/{image}', 'Admin\ProductController@deleteProductImage')->name('admin.product.deleteProductImage');

                // añadir imagen de producto
                Route::post('producto/add-image', 'Admin\ProductController@addProductImage')->name('admin.product.addProductImage');

            // lista de productos

            Route::get('products', 'Admin\ProductController@productList')->name('admin.products');


           // opiniones

           Route::get('opiniones', 'Admin\OpinionsController@opinions')->name('admin.opinions');
           Route::post('opiniones/subir', 'Admin\OpinionsController@addOpinion')->name('admin.subirOpinion');
           Route::put('opinion/{opinion}/edit', 'Admin\OpinionsController@editOpinion')->name('admin.editarOpinion');
           Route::delete('opinion/{opinion}/delete', 'Admin\OpinionsController@deleteOpinion')->name('admin.eliminarOpinion');
           Route::post('opiniones/background/add', 'Admin\OpinionsController@storeBackgroundImage')->name('admin.opinions.addBackground');

           // whatsapp

           Route::get('whatsapp', 'Admin\WhatsAppController@whatsapp')->name('admin.whatsapp');
           Route::post('whatsapp/create', 'Admin\WhatsAppController@addWhatsApp')->name('admin.subirWhatsApp');
           Route::put('whatsapp/{whatsapp}/edit', 'Admin\WhatsAppController@editWhatsApp')->name('admin.editarWhatsApp');

           // contadores

           Route::get('contadores', 'Admin\CountersController@index')->name('admin.contadores');
           Route::post('contadores/subir', 'Admin\CountersController@addCounter')->name('admin.subirContador');
           Route::put('contadores/{counter}/edit', 'Admin\CountersController@editCounter')->name('admin.editarContador');
           Route::delete('contadores/{counter}/delete', 'Admin\CountersController@deleteCounter')->name('admin.eliminarContador');


        });

});


// RUTAS PUBLICAS

Route::get('/', 'FrontController@index')->name('front.index');

require __DIR__.'/auth.php';
