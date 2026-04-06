<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Guest room catalog
Route::get('/rooms', [\App\Http\Controllers\BookingController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{roomType}', [\App\Http\Controllers\BookingController::class, 'show'])->name('rooms.show');

// Auth booking
Route::middleware('auth')->group(function () {
    Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])
        ->middleware('throttle:5,1') // Rate limit 5/min
        ->name('bookings.store');
    
    Route::resource('reviews', ReviewController::class)->only(['create', 'store']);
});

// Midtrans webhook (no auth)
Route::post('/webhook/midtrans', [\App\Http\Controllers\MidtransWebhookController::class, 'handle'])
    ->name('midtrans.webhook');

// Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/rooms', [App\Http\Controllers\AdminController::class, 'rooms'])->name('rooms.index');
            Route::get('/rooms/create', [App\Http\Controllers\AdminController::class, 'createRoom'])->name('rooms.create');
            Route::post('/rooms', [App\Http\Controllers\AdminController::class, 'storeRoom'])->name('rooms.store');
        });

});
