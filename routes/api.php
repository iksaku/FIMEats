<?php

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

Route::prefix('v2')->group(function () {
    Route::prefix('faculty')->group(function () {
        Route::get('/', 'v2\FacultyController@index');
        Route::get('/{name}', 'v2\FacultyController@show');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', 'v2\CategoryController@index');
        Route::get('/{name}', 'v2\CategoryController@show');
    });

    Route::get('product/{name}', 'v2\ProductController@show');
});
