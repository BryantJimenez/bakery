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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
	/////////////////////////////////////// ADMIN ///////////////////////////////////////////////////

	// Home
	Route::get('/', 'AdminController@index')->name('admin');

	// Profile
	Route::group(['prefix' => 'profile'], function () {
		Route::get('/', 'AdminController@profile')->name('profile');
		Route::get('/edit', 'AdminController@profileEdit')->name('profile.edit');
		Route::put('/', 'AdminController@profileUpdate')->name('profile.update');
	});

	// Users
	Route::group(['prefix' => 'users'], function () {
		Route::get('/', 'UserController@index')->name('users.index')->middleware('permission:users.index');
		Route::get('/create', 'UserController@create')->name('users.create')->middleware('permission:users.create');
		Route::post('', 'UserController@store')->name('users.store')->middleware('permission:users.create');
		Route::get('/{user:slug}', 'UserController@show')->name('users.show')->middleware('permission:users.show');
		Route::get('/{user:slug}/edit', 'UserController@edit')->name('users.edit')->middleware('permission:users.edit');
		Route::put('/{user:slug}', 'UserController@update')->name('users.update')->middleware('permission:users.edit');
		Route::delete('/{user:slug}', 'UserController@destroy')->name('users.delete')->middleware('permission:users.delete');
		Route::put('/{user:slug}/activate', 'UserController@activate')->name('users.activate')->middleware('permission:users.active');
		Route::put('/{user:slug}/deactivate', 'UserController@deactivate')->name('users.deactivate')->middleware('permission:users.deactive');
	});

	// Customers
	Route::group(['prefix' => 'customers'], function () {
		Route::get('/', 'CustomerController@index')->name('customers.index')->middleware('permission:customers.index');
		Route::get('/create', 'CustomerController@create')->name('customers.create')->middleware('permission:customers.create');
		Route::post('', 'CustomerController@store')->name('customers.store')->middleware('permission:customers.create');
		Route::get('/{customer:slug}', 'CustomerController@show')->name('customers.show')->middleware('permission:customers.show');
		Route::get('/{customer:slug}/edit', 'CustomerController@edit')->name('customers.edit')->middleware('permission:customers.edit');
		Route::put('/{customer:slug}', 'CustomerController@update')->name('customers.update')->middleware('permission:customers.edit');
		Route::delete('/{customer:slug}', 'CustomerController@destroy')->name('customers.delete')->middleware('permission:customers.delete');
		Route::put('/{customer:slug}/activate', 'CustomerController@activate')->name('customers.activate')->middleware('permission:customers.active');
		Route::put('/{customer:slug}/deactivate', 'CustomerController@deactivate')->name('customers.deactivate')->middleware('permission:customers.deactive');
	});

	// Categories
	Route::group(['prefix' => 'categories'], function () {
		Route::get('/', 'CategoryController@index')->name('categories.index')->middleware('permission:categories.index');
		Route::get('/create', 'CategoryController@create')->name('categories.create')->middleware('permission:categories.create');
		Route::post('', 'CategoryController@store')->name('categories.store')->middleware('permission:categories.create');
		Route::get('/{category:slug}/edit', 'CategoryController@edit')->name('categories.edit')->middleware('permission:categories.edit');
		Route::put('/{category:slug}', 'CategoryController@update')->name('categories.update')->middleware('permission:categories.edit');
		Route::delete('/{category:slug}', 'CategoryController@destroy')->name('categories.delete')->middleware('permission:categories.delete');
		Route::put('/{category:slug}/activate', 'CategoryController@activate')->name('categories.activate')->middleware('permission:categories.active');
		Route::put('/{category:slug}/deactivate', 'CategoryController@deactivate')->name('categories.deactivate')->middleware('permission:categories.deactive');
	});
});