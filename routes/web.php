<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PageController;
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

Route::auth([
    'verify' => false,
    'confirm' => false
]);

Route::controller(PageController::class)->name('pages.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::middleware('auth')->group(function () {
    Route::name('admin.')->prefix('admin')->group(function () {

        Route::get('/', DashboardController::class)->name('index');

        Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::patch('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    Route::controller(ProfileController::class)->name('profile.')->prefix('profile')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/{id}', 'update')->name('update');
    });
});
