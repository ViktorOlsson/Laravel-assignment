<?php

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

// Route to index page
Route::get('/', 'PagesController@index');

// CRUD route for products 
Route::resource('products', 'ProductsController');

// Route to stores
Route::get('/stores', 'StoresController@index');

// Route to reviews
Route::get('/reviews', 'ReviewsController@index');

// Authentication 
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
