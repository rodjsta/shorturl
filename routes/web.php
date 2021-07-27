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

Route::get('/', 		'LinkController@index')->name('link');
Route::post('/', 		'LinkController@store')->name('link.store');
Route::get('/{hash}', 	'LinkController@show')->name('link.show');