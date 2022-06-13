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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/','App\Http\Controllers\PagesController@index');
Route::get('/about','App\Http\Controllers\PagesController@about');
Route::get('/services','App\Http\Controllers\PagesController@services');

Route::resource('posts','App\Http\Controllers\PostsController');
  

/*
Route::get('/hello', function () {
    return "<h1>Hello World</h1>";
});

Route::get('/about', function () {
    return view('dashboards.about'); 
});

Route::get('/users/{id}', function ($id) {
    return 'this the user '.$id; 
});
@
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/post/{post}/likes', [App\Http\Controllers\PostLikeController::class, 'store'])->name('posts.likes');

Route::delete('/post/{post}/likes', [App\Http\Controllers\PostLikeController::class, 'destroy'])->name('likes.delete');

Route::delete('/post/{post}/delete', [App\Http\Controllers\PostsController::class, 'destroy'])->name('post.delete');