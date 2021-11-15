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
    
            Route::get('/home-slider', 'Admin\AdminController@homeSlider')->name('admin.homeSlider');

            Route::post('/agregar-slider', 'Admin\AdminController@subirSlider')->name('admin.subirSlider');

            Route::post('/home-slider/{id}/editar', 'Admin\AdminController@editarSlider')->name('admin.editarSlider');

            Route::delete('/home-slider/{id}/eliminar', 'Admin\AdminController@eliminarSlider')->name('admin.eliminarSlider');
        });

});

require __DIR__.'/auth.php';
