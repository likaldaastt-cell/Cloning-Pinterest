<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');

Route::middleware('auth')->group(function () {
    Route::post('/pins/{pin}/like', [LikeController::class, 'store'])->name('pins.like');
    Route::delete('/pins/{pin}/like', [LikeController::class, 'destroy'])->name('pins.unlike');
});