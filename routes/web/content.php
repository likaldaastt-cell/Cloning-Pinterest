<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\PinController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resource('boards', BoardController::class);
    Route::resource('pins', PinController::class)->except(['index', 'show']);
});

// Detail pin boleh dilihat tanpa login. Didaftarkan setelah /pins/create.
Route::get('/pins/{pin}', [PinController::class, 'show'])->name('pins.show');