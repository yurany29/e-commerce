<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Auth::routes();
Route::get('/',[ProductController::class, 'home'])->name('books.home');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home'); //Ruta de despues de autentificacion "HOME"


	//users
	Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index');
		Route::post('/', 'store')->name('users.store');
		Route::put('/{user}', 'update')->name('users.update');
		Route::delete('/{user}', 'destroy')->name('users.destroy');
	});

	//products
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

});
