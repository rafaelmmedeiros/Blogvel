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
    return view('startingPage');
});

Route::get('/info', function () {
    return view('info');
});

Route::resource('article', 'ArticleController');
Route::resource('comment', 'CommentController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// CREATING COMMENT
Route::get('/comment/create/{article_id}', 'CommentController@create');

// DELETING IMAGE
Route::get('/image/delete/{article_id}', 'ArticleController@deleteImages');
