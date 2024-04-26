<?php

use App\Http\Controllers\Client\PhoneClientController;
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/phones', [\App\Http\Controllers\Admin\PhoneAdminController::class, 'index'])->name('admin.phones');
});


Route::get('/', [\App\Http\Controllers\Client\PhoneClientController::class, 'index']);
Route::resource('/phones', \App\Http\Controllers\Client\PhoneClientController::class);
Route::get('/search', [PhoneClientController::class, 'search'])->name('search');
