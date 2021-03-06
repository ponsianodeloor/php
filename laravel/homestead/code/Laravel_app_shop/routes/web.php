<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

//Route::get('/products', 'ProductsController@index');

Route::middleware(['auth','admin'])->group(function () {
   Route::get('/admin/products/guardar', 'ProductsController@formGuardar');
   Route::post('/admin/products/guardar', 'ProductsController@guardar');
   Route::resource('admin/products', 'ProductsController');Route::get('/admin/products/guardar', 'ProductsController@formGuardar');

   Route::resource('admin/products/image', 'ProductImagesController');
});




Route::get('/suma', 'TestController@suma');
Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
