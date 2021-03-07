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
Route::get('chat', 'App\Http\Controllers\ChatController@index');
Route::get('ajax/chat', 'App\Http\Controllers\Ajax\ChatController@index');
Route::post('ajax/chat', 'App\Http\Controllers\Ajax\ChatController@create');