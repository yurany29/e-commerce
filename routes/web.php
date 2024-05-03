<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Auth::routes();
Route::get('/',[ProductController::class, 'home'])->name('products.home');

//products user
Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
	Route::get('/show/{product}', 'show')->name('products.show');
	Route::get('/search', 'search')->name('products.search');
});

//categories user
Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
	Route::get('/all/{category}', 'show')->name('categories.show');
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home'); //Ruta de despues de autentificacion "HOME"


	//users
	Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index');
		Route::post('/', 'store')->name('users.store');
		Route::put('/{user}', 'update')->name('users.update');
		Route::delete('/{user}', 'destroy')->name('users.destroy');
	});

	//products admin
	Route::group(['prefix' => 'products', 'middleware' => ['role:admin'], 'controller' => ProductController::class], function () {
		Route::get('/', 'index')->name('products.index');
		Route::post('/store', 'store')->name('products.store');
		Route::post('/update/{product}', 'update')->name('products.update');
		Route::delete('/{product}', 'destroy')->name('products.destroy');
	});


	//categories
	Route::group(['prefix' => 'categories', 'middleware' => ['role:admin'], 'controller' => CategoryController::class], function () {
		Route::get('/', 'index')->name('categories.index');
		Route::post('/', 'store')->name('categories.store');
		Route::put('/{category}', 'update')->name('categories.update');
		Route::delete('/{category}', 'destroy')->name('categories.destroy');
	});

	//cart
	Route::group(['prefix' => 'carts', 'middleware' => ['role:user'], 'controller' => CartController::class], function () {
		Route::get('/', 'index')->name('carts.index');
		Route::post('/', 'store')->name('carts.store');
		Route::put('/plus/{cart}', 'updateplus')->name('carts.update');
		Route::put('/minus/{cart}', 'updateminus')->name('carts.update');
		Route::delete('/{cart}', 'destroy')->name('carts.destroy');
	});

});
