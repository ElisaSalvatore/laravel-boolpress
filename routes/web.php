<?php

use Illuminate\Support\Facades\Auth;
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

// Commento questa rotta perchè ho creato la rotta generica {any}, vedi al fondo del file.
// Route::get('/', 'HomeController@index');

Auth::routes();

// Route::get('/admin', 'Admin\HomeController@index')->name('admin.home')->middleware('auth');

// POSTS ROUTE
// Route::get('/admin/posts/', 'Admin\PostController@index')->name('admin.post.index')->middleware('auth');
// Route::get('/admin/posts/create', 'Admin\PostController@index')->name('admin.post.create')->middleware('auth');
// Route::get('/admin/posts/edit', 'Admin\PostController@index')->name('admin.post.edit')->middleware('auth');

Route::middleware("auth")
->namespace("Admin")
->prefix("admin")
->name("admin.")
->group(function () {
  Route::get('/', 'HomeController@index')->name('home');
  // Route::get('/posts/', 'PostController@index')->name('posts.index');
  // Route::get('/posts/create', 'PostController@index')->name('post.create');
  // Route::get('/posts/edit', 'PostController@index')->name('post.edit');

  // Creo le rotte di Posts usando ::resource()
  Route::resource("posts", "PostController");
  
  // Creo le rotte di Users usando ::resource()
  Route::resource("users", "UserController");
  // Route::get("users", "UserController@index")->name("users.index");

  Route::get("contacts", "ContactController@index")->name("contacts.index");
});

// Rotta generica creata per evitare l'errore 404 nel caso in cui venga inserita 
// una query che non corrisponde ad una specifica rotta:
Route::get("{any?}", function () {
  return view("home");
})->where("any", ".*");