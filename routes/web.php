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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::resource('threads', 'ThreadController', [
    'except' => ['show']
]);
Route::get('threads/{channel}/{thread}', ["uses" => 'ThreadController@show', "as" => "threads.show"]);

Route::post('/threads/{thread}/replies', [
    'uses' => 'ReplyController@store',
    'as' => 'replies.store'
]);

Route::get('threads/{channel}', ["uses" => "ThreadController@index", "as" => "threads.channel"]);

Route::post('replies/{reply}/favorites', [
    'uses' => 'FavoritesController@store',
    'as' => 'favorites.store'
]);