<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DisableDaysController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\StaysController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CommentsController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin')->name('admin.')->prefix('admin')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('features', FeaturesController::class)->except('show');
    Route::resource('stays', StaysController::class)->except('show');
    Route::resource('stays/{stay}/rooms', RoomsController::class)->except('show');
    Route::resource('rooms/{room}/disable-days', DisableDaysController::class)->only('index', 'create', 'store', 'destroy');
    Route::resource('bookings', BookingController::class)->only('index', 'update');
    Route::resource('comments', CommentsController::class)->only('index', 'update', 'destroy');

});
