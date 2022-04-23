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
        });

});

require __DIR__.'/auth.php';
