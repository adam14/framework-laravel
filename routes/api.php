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

    // CRUD Category
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', 'CategoriesController@index');
        Route::get('/detail/{id}', 'CategoriesController@detail');
        Route::post('/add', 'CategoriesController@add');
        Route::put('/edit/{id}', 'CategoriesController@edit');
        Route::delete('/delete/{id}', 'CategoriesController@delete');
    });

    // CRUD Product
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', 'ProductsController@index');
        Route::get('/detail/{id}', 'ProductsController@detail');
        Route::post('/add', 'ProductsController@add');
        Route::put('/edit/{id}', 'ProductsController@edit');
        Route::delete('/delete/{id}', 'ProductsController@delete');
    });
});