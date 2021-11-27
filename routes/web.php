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

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////

Auth::routes(['register' => false]);
Route::get('/users/email', 'AdminController@emailVerifyAdmin');

/////////////////////////////////////////////// WEB ////////////////////////////////////////////////
Route::get('/', 'WebController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {
	/////////////////////////////////////// ADMIN ///////////////////////////////////////////////////

	// Home
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/admin/profile', 'AdminController@profile')->name('profile');
	Route::get('/admin/profile/edit', 'AdminController@profileEdit')->name('profile.edit');
	Route::put('/admin/profile/', 'AdminController@profileUpdate')->name('profile.update');

	// Users
	Route::get('/admin/users', 'UserController@index')->name('users.index')->middleware('permission:users.index');
	Route::get('/admin/users/registrar', 'UserController@create')->name('users.create')->middleware('permission:users.create');
	Route::post('/admin/users', 'UserController@store')->name('users.store')->middleware('permission:users.create');
	Route::get('/admin/users/{user:slug}', 'UserController@show')->name('users.show')->middleware('permission:users.show');
	Route::get('/admin/users/{user:slug}/edit', 'UserController@edit')->name('users.edit')->middleware('permission:users.edit');
	Route::put('/admin/users/{user:slug}', 'UserController@update')->name('users.update')->middleware('permission:users.edit');
	Route::delete('/admin/users/{user:slug}', 'UserController@destroy')->name('users.delete')->middleware('permission:users.delete');
	Route::put('/admin/users/{user:slug}/activate', 'UserController@activate')->name('users.activate')->middleware('permission:users.active');
	Route::put('/admin/users/{user:slug}/deactivate', 'UserController@deactivate')->name('users.deactivate')->middleware('permission:users.deactive');
});