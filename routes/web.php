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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/page_1', 'HomeController@page_1')->name('page_1');
Route::get('/page_2', 'HomeController@page_2')->name('page_2');

// Route::post('/comments/{url}', 'CommentController@store');
Route::get('/comments/{url}', 'CommentController@page');

Route::resources([
    'comments' => 'CommentController'
]);