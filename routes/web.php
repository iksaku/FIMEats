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

Route::get('/', 'Main@index')->name('index');
Route::get('facultad/{name}', 'Main@faculty')->name('faculty');
Route::get('comparar', 'Main@compare')->name('compare');
Route::get('categoria/{name}', 'Main@category')->name('category');
