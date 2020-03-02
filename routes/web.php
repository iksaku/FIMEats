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

Route::get('/', 'v2\HomeController@index')->name('home');

Route::prefix('facultad')->group(function () {
    Route::get('/', fn () => route('home'));
    Route::get('{faculty}', 'v2\FacultyController@show')->name('faculty.show');
});

/*Route::prefix('categoria')->group(function () {
    Route::get('/', 'v2\CategoryController@index')->name('category.index');
    Route::get('{category}', 'v2\CategoryController@show')->name('category.show');
});*/

Route::get('producto/{product}', 'v2\ProductController@show')->name('product.show');

Route::fallback(fn () => abort(404, 'No hemos encontrado la ruta solicitada.'));
