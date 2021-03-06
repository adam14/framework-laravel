<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {

    // Module Category
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'CategoriesController@index');
        Route::get('/detail/{id}', 'CategoriesController@detail');
        Route::post('/add', 'CategoriesController@add');
        Route::put('/edit/{id}', 'CategoriesController@edit');
        Route::delete('/delete/{id}', 'CategoriesController@delete');
    });

    // Module Category Product
    Route::group(['prefix' => 'category_products'], function() {
        Route::get('/', 'CategoryProductsController@index');
        Route::get('/detail/{id}', 'CategoryProductsController@detail');
        Route::post('/add', 'CategoryProductsController@add');
        Route::put('/edit/{id}', 'CategoryProductsController@edit');
        Route::delete('/delete/{id}', 'CategoryProductsController@delete');
    });

    // Module Images
    Route::group(['prefix' => 'images'], function() {
        Route::get('/', 'ImagesController@index');
        Route::get('/detail/{id}', 'ImagesController@detail');
        Route::post('/add', 'ImagesController@add');
        Route::post('/edit/{id}', 'ImagesController@edit');
        Route::delete('/delete/{id}', 'ImagesController@delete');
    });

    // Module Product
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', 'ProductsController@index');
        Route::get('/detail/{id}', 'ProductsController@detail');
        Route::post('/add', 'ProductsController@add');
        Route::put('/edit/{id}', 'ProductsController@edit');
        Route::delete('/delete/{id}', 'ProductsController@delete');
    });

    // Module Product Images
    Route::group(['prefix' => 'product_images'], function() {
        Route::get('/', 'ProductImagesController@index');
        Route::get('/detail/{id}', 'ProductImagesController@detail');
        Route::post('/add', 'ProductImagesController@add');
        Route::put('/edit/{id}', 'ProductImagesController@edit');
        Route::delete('/delete/{id}', 'ProductImagesController@delete');
    });
});