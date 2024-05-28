<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest:admin')->group(function () {
    Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name("login");
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Start Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category/store', 'store')->name('category.store');
        Route::get('category/edit/{slug}', 'edit')->name('category.edit');
        Route::put('category/update/{slug}', 'update')->name('category.update');
        Route::delete('category/destroy/{slug}', 'destroy')->name('category.destroy');
    });

    // Start Porducts
    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index')->name('products.index');
        Route::get('products/create', 'create')->name('products.create');
        Route::post('products/store', 'store')->name('products.store');
        Route::get('products/edit/{slug}', 'edit')->name('products.edit');
        Route::put('products/update/{slug}', 'update')->name('products.update');
        Route::delete('products/destroy/{slug}', 'destroy')->name('products.destroy');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('setting',  'index')->name('setting.index');
        Route::patch('setting/update/{id}', 'update')->name('setting.update');
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
