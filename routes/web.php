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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group([ 'middleware' => 'auth' ],function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('item', 'ItemController');
    Route::resource('customer', 'CustomerController');

    Route::resource('sale', 'SaleController');
    Route::get('sale-info/{id}', 'SaleController@sale_info')->name('sale.pdf');
    Route::get('get-customer', 'SaleController@get_customer')->name('get-customer');
    Route::get('searchProduct', 'SaleController@searchProduct')->name('searchProduct');


});


