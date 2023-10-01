<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\StaysController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\IndexController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');
});

Route::prefix('stays')->group(function () {
    Route::get('{stay}', [StaysController::class, 'show'])->name('stays.show');
    Route::post('/{stay}/comments', [CommentsController::class,'store'])->name('stays.comment.store');
});

Route::middleware('auth')->prefix('bookings')->group(function () {
    Route::get('', [BookingController::class, 'index'])->name('booking.index');
    Route::post('stays/{stay}/rooms/{room}/book', [BookingController::class, 'store'])->name('booking.store');
});


require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
