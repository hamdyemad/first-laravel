<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::group(['prefix' => 'admin'], function () {
  // products routes//
  Route::group(['prefix' => '/products'], function () {
    Route::get('/show', 'ProductsController@index')->name('products.showAll');
    Route::get('/show/{id}', 'ProductsController@show')->name('products.show');
    Route::get('/create', 'ProductsController@create')->name('products.create');
    Route::post('/store', 'ProductsController@store')->name('products.store');
    Route::get('/edit/{id}', 'ProductsController@edit')->name('products.edit');
    Route::put('/update/{id}', 'ProductsController@update')->name('products.update');
    Route::delete('/delete/{id}', 'ProductsController@destroy')->name('products.delete');
  });

  // categories routes//
  Route::group(['prefix' => '/categories'], function () {
    Route::get('/show', 'CategoriesController@index')->name('categories.showAll');
    Route::get('/create', 'CategoriesController@create')->name('categories.create');
    Route::post('/store', 'CategoriesController@store')->name('categories.store');
    Route::get('/edit/{id}', 'CategoriesController@edit')->name('categories.edit');
    Route::delete('/delete/{id}', 'CategoriesController@destroy')->name('categories.delete');
  });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
