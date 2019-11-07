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

// CRUD routes for products 
Route::get('/products', 'ProductsController@index');
Route::get('/products/create', 'ProductsController@create');

// CRUD routes for products
//Route::post('/products', 'ProductsController@store');
//Route::get('/products/{$id}', 'ProductsController@show');
//Route::patch('/products/{id}', 'ProductsController@update');
//Route::delete('/products/{id}', 'ProductsController@destroy');
//Route::get('/products/{id}/edit', 'ProductsController@edit');
