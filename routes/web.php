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

Route::get('/', function () {
    return view('welcome');
});


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
            Route::get('nosotras', 'Admin\AdminController@nosotras')->name('admin.nosotras');
            Route::post('/nosotras/add', 'Admin\AdminController@addToNosotras')->name('admin.nosotras.add');
            Route::delete('/nosotras/delete', 'Admin\AdminController@deleteNosotrasImage')->name('admin.nosotras.delete');

            // categorias
            Route::get('/categorias', 'Admin\AdminController@categories')->name('admin.categories');
            Route::post('categorias/create', 'Admin\AdminController@createCategory')->name('admin.categories.create');
            Route::delete('categorias/delete', 'Admin\AdminController@deleteCategory')->name('admin.categories.delete');
            Route::get('/categorias/get', 'Admin\AdminController@getCategory')->name('admin.categories.get');
            Route::get('categoria/{slug}', 'Admin\AdminController@showCategory')->name('admin.categories.show');
            Route::post('/categoria/{slug}/create-product', 'Admin\AdminController@createProduct')->name('admin.product.create');

            // productos
            Route::get('producto/{slug}', 'Admin\AdminController@showProduct')->name('admin.product.show');
            Route::delete('producto/{product}', 'Admin\AdminController@deleteProduct')->name('admin.product.delete');
            Route::post('producto/{product}/edit', 'Admin\AdminController@editProduct')->name('admin.product.edit');
            Route::get('producto/{product}/imagenes', 'Admin\AdminController@editProductImages')->name('admin.product.images');

                // editar imagen del producto
                Route::post('producto/edit-image', 'Admin\AdminController@editProductImage')->name('admin.product.editProductImage');

                //borrar imagen del producto
                Route::delete('producto/delete-image/{image}', 'Admin\AdminController@deleteProductImage')->name('admin.product.deleteProductImage');
            
        });

});

require __DIR__.'/auth.php';
