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
    Route::resource('phones', \App\Http\Controllers\Admin\PhoneAdminController::class);
    Route::delete('/destroyReview/{reviewId}', [\App\Http\Controllers\Admin\PhoneAdminController::class, 'destroyReview'])->name('destroyReview');

});


Route::get('/', [\App\Http\Controllers\Client\PhoneClientController::class, 'index']);
Route::resource('/phones', \App\Http\Controllers\Client\PhoneClientController::class);
Route::get('/search', [PhoneClientController::class, 'search'])->name('search');


Route::get('/about-us', function () {
    return view('client.about-us');
});
Route::get('/contact', function () {
    return view('client.contact');
});

Route::get('/terms-of-use', function () {
    return view('client.terms-of-use');
});

Route::get('/privacy-policy', function () {
    return view('client.terms-of-use');
});
