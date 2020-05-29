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
    return redirect('products-list');
});

Route::resource('products', 'ProductController');
// display products list
Route::get('products-list', ['uses'=>'ProductController@index', 'as'=>'products.list']);

// display add product form and create a new product
Route::get('product-add', ['uses'=>'ProductController@create', 'as'=>'product.add']);
Route::post('product-post', ['uses'=>'ProductController@store', 'as'=>'product.post']);

// display view product
Route::get('product-view/{id?}', ['uses'=>'ProductController@view', 'as'=>'product.view']);

// display edit product form and save a product
Route::get('product-edit/{id?}', ['uses'=>'ProductController@edit', 'as'=>'product.edit']);

// delete a product
Route::get('product-delete/{id?}', ['uses'=>'ProductController@delete', 'as'=>'product.delete']);
Route::get('product-destroy/{id?}', ['uses'=>'ProductController@destroy', 'as'=>'product.destroy']);