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

Route::resource('public-articles', App\Http\Controllers\PublicArticleController::class);

Route::resource('public-products', App\Http\Controllers\PublicProductController::class);

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
    ->prefix('crm')
    ->group(static function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/discord', [App\Http\Controllers\DiscordController::class, 'index'])->name('discord');
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('products', App\Http\Controllers\ProductController::class);
        Route::resource('product-categories', App\Http\Controllers\ProductCategoryController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
        Route::resource('images', App\Http\Controllers\ImageController::class);
        Route::resource('articles', App\Http\Controllers\ArticleController::class);
        Route::resource('images', App\Http\Controllers\ImageController::class);
        Route::resource('trait-images', App\Http\Controllers\TraitImageController::class);
//        Route::post('/file-upload', [App\Http\Controllers\ImageController::class, 'store'])->name('');
    });

//Route::view('/file-upload', 'images.index')->name('images.index');
//Route::post('/file-upload', [App\Http\Controllers\ImageController::class, 'store']);
//Route::get('/view-uploads', [App\Http\Controllers\ImageController::class, 'viewUploads']);

//Route::resource('permissions', App\Http\Controllers\PermissionController::class);

//Route::get('/users', 'UserController@index')->name('users.index');
//Route::get('/users/create', 'UserController@create')->name('users.create');
//Route::get('/users/{user}', 'UserController@edit')->name('users.edit');
//Route::post('/store', 'UserController@store')->name('users.store');
//Route::post('/users/{user}/update', 'UserController@update')->name('users.update');
//Route::post('/users/{user}/delete', 'UserController@delete')->name('users.delete');
