<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\AdminController;

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
            
            Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    
            Route::get('/home-slider', 'AdminController@homeSlider')->name('admin.homeSlider');

            Route::post('/agregar-slider', 'AdminController@subirSlider')->name('admin.subirSlider');
        });

});

require __DIR__.'/auth.php';
