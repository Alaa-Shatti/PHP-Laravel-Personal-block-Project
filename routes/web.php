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

Route::get('/', 'PublicController@index')->name('index');
Route::get('post/{post}', 'PublicController@singlePost')->name('singlePost');
Route::get('about', 'PublicController@about')->name('about');
Route::get('contact', 'PublicController@contact')->name('contact');
Route::post('contact', 'PublicController@contactPost')->name('contactPost');


Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::prefix('user')->group(function () {
    Route::get('dashboard', 'UserController@dashboard')->name('userDashboard');
    Route::get('comments', 'UserController@comments')->name('userComments');
        Route::post('comment/{id}/delete', 'UserController@deleteComment')->name('deleteComments');
    Route::get('profile', 'UserController@profile')->name('userProfile');
    Route::post('profile', 'UserController@profilePost')->name('userProfilePost');
});

Route::prefix('author')->group(function () {
    Route::get('dashboard', 'AuthorController@dashboard')->name('authorDashboard');
    Route::get('post', 'AuthorController@post')->name('authorPost');
    Route::get('post/new', 'AuthorController@newPost')->name('newPost');
    Route::post('post/new', 'AuthorController@createPost')->name('createPost');
    Route::get('post/{id}/edit', 'AuthorController@postEdit')->name('postEdit');
    Route::post('post/{id}/edit', 'AuthorController@postEditPost')->name('postEditPost');
    Route::post('post/{id}/delete', 'AuthorController@deletePost')->name('deletePost');
    Route::get('comments', 'AuthorController@comments')->name('authorComments');
});

Route::prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('adminDashboard');
    Route::get('post', 'AdminController@post')->name('adminPost');
    Route::get('comments', 'AdminController@comments')->name('adminComments');
    Route::get('users', 'AdminController@users')->name('adminUsers');
    Route::get('info', 'adminController@info')->name('adminInfo');
});
