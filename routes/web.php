<?php

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
    'reset' => false,
    'verify' => false,
    'confirm' => false
]);

Route::controller(PageController::class)->name('pages.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', DashboardController::class)->name('index');
});
