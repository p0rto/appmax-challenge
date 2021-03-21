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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('products', 'ProductController');
    Route::resource('stocks', 'StockController');

    Route::prefix('reports')->group(function () {
        Route::get('/', 'ReportsController@index');
        Route::get('/added-products', 'ReportsController@addedProducts');
        Route::get('/removed-products', 'ReportsController@removedProducts');
    });
});
