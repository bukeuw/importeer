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

Route::get('/', 'ProductController@importPage');
Route::post('/import', 'ProductController@import');
Route::post('/import-json', 'ProductController@importJson');
Route::get('/image-upload', 'ProductController@uploadForm');
Route::post('/image-upload', 'ProductController@upload');
