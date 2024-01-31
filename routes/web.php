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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();



//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

// 新規登録用view
Route::get('/registerView','Auth\RegisterController@registerView');

// /registerと言うURLに遷移したときにRegisterControllerのregisterメソッドの処理をします。
// Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');

// ログアウト機能
Route::get('/logout','Auth\LoginController@logout');

// 投稿保存用のルート
Route::post('/post', [PostController::class, 'store'])->name('post.store');

// 投稿一覧表示用のルート
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// 登録処理
Route::post('/top', 'PostsController@postCreate')->name('post.create');
// 編集処理
Route::get('/top/edit/{id}', 'PostsController@edit')->name('post.edit');
Route::post('/top/update', 'PostsController@update')->name('post.update');
// 削除処理
Route::get('/top/post/{id}/destroy', 'PostsController@destroy')->name('post.destroy');
