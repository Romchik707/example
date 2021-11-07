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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Route::get('/discord', [App\Http\Controllers\DiscordController::class, 'index'])->name('discord');
//
//Route::resource('users', App\Http\Controllers\UserController::class);
//
//Route::resource('products', App\Http\Controllers\ProductController::class);
//
//Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
//
//Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::middleware(['role:admin', 'auth'])
//    ->name('admin.')
    ->prefix('admin')
    ->group(static function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/discord', [App\Http\Controllers\DiscordController::class, 'index'])->name('discord');
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('products', App\Http\Controllers\ProductController::class);
        Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    });

//Route::resource('permissions', App\Http\Controllers\PermissionController::class);

//Route::get('/users', 'UserController@index')->name('users.index');
//Route::get('/users/create', 'UserController@create')->name('users.create');
//Route::get('/users/{user}', 'UserController@edit')->name('users.edit');
//Route::post('/store', 'UserController@store')->name('users.store');
//Route::post('/users/{user}/update', 'UserController@update')->name('users.update');
//Route::post('/users/{user}/delete', 'UserController@delete')->name('users.delete');
