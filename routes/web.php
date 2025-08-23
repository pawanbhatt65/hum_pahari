<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/homestays', [HomeController::class, 'homestays'])->name('homestays');
Route::get('/homestays/detail', [HomeController::class, 'homeStayDetail'])->name('homeStayDetail');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/details', [HomeController::class, 'productDetail'])->name('productDetail');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog/detail', [HomeController::class, 'blogDetail'])->name('blogDetail');

Route::get('/test-logging', function () {
    \Illuminate\Support\Facades\Log::info('This is a test log message');
    return 'Check your logs!';
});

// location routes
Route::get('/states', [LocationController::class, 'getStates'])->name('states');
Route::get('/states/{stateId}/districts', [LocationController::class, 'getDistricts']);

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/seller.php';
