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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/display_products_form', 'StockMobileController@ShowProductsTable');
Route::get('products', 'StockMobileController@showAllProducts');
Route::get('/delete/{id}', 'StockMobileController@destroy');
Route::get('/edit/{id}', 'StockMobileController@edithProducts');
Route::post('/edit/{id}', 'StockMobileController@updateProducts');
