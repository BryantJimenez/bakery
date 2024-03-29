<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function() {
	/////////////////////////////////////// AUTH ////////////////////////////////////////////////////
	Route::group(['prefix' => 'auth', 'middleware' => 'locale'], function() {
		Route::prefix('login')->group(function () {
			Route::post('/', 'Api\AuthController@login');
		});
		Route::post('/register', 'Api\AuthController@register');
		// Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

		Route::group(['middleware' => 'auth:api'], function() {
			Route::get('/logout', 'Api\AuthController@logout');
		});
	});

	/////////////////////////////////////// ADMIN ////////////////////////////////////////////////////
	Route::group(['middleware' => ['auth:api', 'locale']], function () {
		// Profile
		Route::group(['prefix' => 'profile'], function () {
			Route::get('/', 'Api\Profile\ProfileController@get');
			Route::put('/', 'Api\Profile\ProfileController@update');
			Route::prefix('change')->group(function () {
				Route::post('/password', 'Api\Profile\ProfileController@changePassword');
				Route::post('/email', 'Api\Profile\ProfileController@changeEmail');
			});

			// Orders
			Route::group(['prefix' => 'orders'], function () {
				Route::get('/', 'Api\Profile\OrderController@get');
				Route::get('/{order:id}', 'Api\Profile\OrderController@show');
			});
		});

		// Cart
		Route::group(['prefix' => 'cart'], function () {
			Route::get('/', 'Api\Profile\CartController@get');
			Route::post('/', 'Api\Profile\CartController@store');
			Route::put('/{cart_product:id}/add', 'Api\Profile\CartController@add');
			Route::put('/{cart_product:id}/remove', 'Api\Profile\CartController@remove');
			Route::delete('/{cart_product:id}', 'Api\Profile\CartController@destroy');
		});

		// Users
		Route::group(['prefix' => 'users'], function () {
			Route::get('/', 'Api\UserController@index')->middleware('permission:users.index');
			Route::post('/', 'Api\UserController@store')->middleware('permission:users.create');
			Route::get('/{user:id}', 'Api\UserController@show')->middleware('permission:users.show');
			Route::put('/{user:id}', 'Api\UserController@update')->middleware('permission:users.edit');
			Route::delete('/{user:id}', 'Api\UserController@destroy')->middleware('permission:users.delete');
			Route::put('/{user:id}/activate', 'Api\UserController@activate')->middleware('permission:users.active');
			Route::put('/{user:id}/deactivate', 'Api\UserController@deactivate')->middleware('permission:users.deactive');
		});

		// Customers
		Route::group(['prefix' => 'customers'], function () {
			Route::get('/', 'Api\CustomerController@index')->middleware('permission:customers.index');
			Route::post('/', 'Api\CustomerController@store')->middleware('permission:customers.create');
			Route::get('/{customer:id}', 'Api\CustomerController@show')->middleware('permission:customers.show');
			Route::put('/{customer:id}', 'Api\CustomerController@update')->middleware('permission:customers.edit');
			Route::delete('/{customer:id}', 'Api\CustomerController@destroy')->middleware('permission:customers.delete');
			Route::put('/{customer:id}/activate', 'Api\CustomerController@activate')->middleware('permission:customers.active');
			Route::put('/{customer:id}/deactivate', 'Api\CustomerController@deactivate')->middleware('permission:customers.deactive');
		});

		// Categories
		Route::group(['prefix' => 'categories'], function () {
			Route::get('/', 'Api\CategoryController@index')->middleware('permission:categories.index');
			Route::post('/', 'Api\CategoryController@store')->middleware('permission:categories.create');
			Route::get('/{category:id}', 'Api\CategoryController@show')->middleware('permission:categories.show');
			Route::put('/{category:id}', 'Api\CategoryController@update')->middleware('permission:categories.edit');
			Route::delete('/{category:id}', 'Api\CategoryController@destroy')->middleware('permission:categories.delete');
			Route::put('/{category:id}/activate', 'Api\CategoryController@activate')->middleware('permission:categories.active');
			Route::put('/{category:id}/deactivate', 'Api\CategoryController@deactivate')->middleware('permission:categories.deactive');
		});

		// Products
		Route::group(['prefix' => 'products'], function () {
			Route::get('/', 'Api\ProductController@index')->middleware('permission:products.index');
			Route::post('/', 'Api\ProductController@store')->middleware('permission:products.create');
			Route::get('/{product:id}', 'Api\ProductController@show')->middleware('permission:products.show');
			Route::put('/{product:id}', 'Api\ProductController@update')->middleware('permission:products.edit');
			Route::delete('/{product:id}', 'Api\ProductController@destroy')->middleware('permission:products.delete');
			Route::put('/{product:id}/activate', 'Api\ProductController@activate')->middleware('permission:products.active');
			Route::put('/{product:id}/deactivate', 'Api\ProductController@deactivate')->middleware('permission:products.deactive');
			Route::put('/{product:id}/assign', 'Api\ProductController@assign')->middleware('permission:products.assign.groups');
		});

		// Complements
		Route::group(['prefix' => 'complements'], function () {
			Route::get('/', 'Api\ComplementController@index')->middleware('permission:complements.index');
			Route::post('/', 'Api\ComplementController@store')->middleware('permission:complements.create');
			Route::get('/{complement:id}', 'Api\ComplementController@show')->middleware('permission:complements.show');
			Route::put('/{complement:id}', 'Api\ComplementController@update')->middleware('permission:complements.edit');
			Route::delete('/{complement:id}', 'Api\ComplementController@destroy')->middleware('permission:complements.delete');
			Route::put('/{complement:id}/activate', 'Api\ComplementController@activate')->middleware('permission:complements.active');
			Route::put('/{complement:id}/deactivate', 'Api\ComplementController@deactivate')->middleware('permission:complements.deactive');
		});

		// Groups
		Route::group(['prefix' => 'groups'], function () {
			Route::get('/', 'Api\GroupController@index')->middleware('permission:groups.index');
			Route::post('/', 'Api\GroupController@store')->middleware('permission:groups.create');
			Route::get('/{group:id}', 'Api\GroupController@show')->middleware('permission:groups.show');
			Route::put('/{group:id}', 'Api\GroupController@update')->middleware('permission:groups.edit');
			Route::delete('/{group:id}', 'Api\GroupController@destroy')->middleware('permission:groups.delete');
			Route::put('/{group:id}/activate', 'Api\GroupController@activate')->middleware('permission:groups.active');
			Route::put('/{group:id}/deactivate', 'Api\GroupController@deactivate')->middleware('permission:groups.deactive');
			Route::put('/{group:id}/assign', 'Api\GroupController@assign')->middleware('permission:groups.assign.complements');
		});

		// Orders
		Route::group(['prefix' => 'orders'], function () {
			Route::get('/', 'Api\OrderController@index')->middleware('permission:orders.index');
			Route::get('/{order:id}', 'Api\OrderController@show')->middleware('permission:orders.show');
			Route::put('/{order:id}/confirm', 'Api\OrderController@confirm')->middleware('permission:orders.confirmed');
			Route::put('/{order:id}/reject', 'Api\OrderController@reject')->middleware('permission:orders.rejected');
		});

		// Agencies
		Route::group(['prefix' => 'agencies'], function () {
			Route::get('/', 'Api\AgencyController@index')->middleware('permission:agencies.index');
			Route::post('/', 'Api\AgencyController@store')->middleware('permission:agencies.create');
			Route::get('/{agency:id}', 'Api\AgencyController@show')->middleware('permission:agencies.show');
			Route::put('/{agency:id}', 'Api\AgencyController@update')->middleware('permission:agencies.edit');
			Route::delete('/{agency:id}', 'Api\AgencyController@destroy')->middleware('permission:agencies.delete');
			Route::put('/{agency:id}/activate', 'Api\AgencyController@activate')->middleware('permission:agencies.active');
			Route::put('/{agency:id}/deactivate', 'Api\AgencyController@deactivate')->middleware('permission:agencies.deactive');
		});

		// Attributes
		Route::group(['prefix' => 'attributes'], function () {
			Route::get('/', 'Api\AttributeController@index')->middleware('permission:attributes.index');
			Route::post('/', 'Api\AttributeController@store')->middleware('permission:attributes.create');
			Route::get('/{attribute:id}', 'Api\AttributeController@show')->middleware('permission:attributes.show');
			Route::put('/{attribute:id}', 'Api\AttributeController@update')->middleware('permission:attributes.edit');
			Route::delete('/{attribute:id}', 'Api\AttributeController@destroy')->middleware('permission:attributes.delete');
			Route::put('/{attribute:id}/activate', 'Api\AttributeController@activate')->middleware('permission:attributes.active');
			Route::put('/{attribute:id}/deactivate', 'Api\AttributeController@deactivate')->middleware('permission:attributes.deactive');
		});

		// Coupons
		Route::group(['prefix' => 'coupons'], function () {
			Route::get('/', 'Api\CouponController@index')->middleware('permission:coupons.index');
			Route::post('/', 'Api\CouponController@store')->middleware('permission:coupons.create');
			Route::get('/{coupon:id}', 'Api\CouponController@show')->middleware('permission:coupons.show');
			Route::put('/{coupon:id}', 'Api\CouponController@update')->middleware('permission:coupons.edit');
			Route::delete('/{coupon:id}', 'Api\CouponController@destroy')->middleware('permission:coupons.delete');
			Route::put('/{coupon:id}/activate', 'Api\CouponController@activate')->middleware('permission:coupons.active');
			Route::put('/{coupon:id}/deactivate', 'Api\CouponController@deactivate')->middleware('permission:coupons.deactive');
		});

		// Currencies
		Route::group(['prefix' => 'currencies'], function () {
			Route::get('/', 'Api\CurrencyController@index')->middleware('permission:currencies.index');
			Route::post('/', 'Api\CurrencyController@store')->middleware('permission:currencies.create');
			Route::get('/{currency:id}', 'Api\CurrencyController@show')->middleware('permission:currencies.show');
			Route::put('/{currency:id}', 'Api\CurrencyController@update')->middleware('permission:currencies.edit');
			Route::delete('/{currency:id}', 'Api\CurrencyController@destroy')->middleware('permission:currencies.delete');
			Route::put('/{currency:id}/activate', 'Api\CurrencyController@activate')->middleware('permission:currencies.active');
			Route::put('/{currency:id}/deactivate', 'Api\CurrencyController@deactivate')->middleware('permission:currencies.deactive');
		});

		// Languages
		Route::group(['prefix' => 'languages'], function () {
			Route::get('/', 'Api\LanguageController@index')->middleware('permission:languages.index');
			Route::post('/', 'Api\LanguageController@store')->middleware('permission:languages.create');
			Route::get('/{language:id}', 'Api\LanguageController@show')->middleware('permission:languages.show');
			Route::delete('/{language:id}', 'Api\LanguageController@destroy')->middleware('permission:languages.delete');
		});

		// Schedules
		Route::group(['prefix' => 'schedules'], function () {
			Route::get('/', 'Api\ScheduleController@index')->middleware('permission:schedules.index');
			Route::post('/', 'Api\ScheduleController@store')->middleware('permission:schedules.create');
			Route::get('/{schedule:id}', 'Api\ScheduleController@show')->middleware('permission:schedules.show');
			Route::put('/{schedule:id}', 'Api\ScheduleController@update')->middleware('permission:schedules.edit');
			Route::delete('/{schedule:id}', 'Api\ScheduleController@destroy')->middleware('permission:schedules.delete');
			Route::put('/{schedule:id}/activate', 'Api\ScheduleController@activate')->middleware('permission:schedules.active');
			Route::put('/{schedule:id}/deactivate', 'Api\ScheduleController@deactivate')->middleware('permission:schedules.deactive');
		});

		// Settings
		Route::group(['prefix' => 'settings'], function () {
			Route::get('/', 'Api\SettingController@get')->middleware('permission:settings.index');
			Route::get('/terms', 'Api\SettingController@terms')->middleware('permission:settings.index');
			Route::get('/privacity', 'Api\SettingController@privacity')->middleware('permission:settings.index');
			Route::put('/', 'Api\SettingController@update')->middleware('permission:settings.edit');
		});
	});
});