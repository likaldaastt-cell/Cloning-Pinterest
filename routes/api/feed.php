<?php

use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/pins', [FeedController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pins/{pin}/like', [LikeController::class, 'store'])->name('api.pins.like');
    Route::delete('/pins/{pin}/like', [LikeController::class, 'destroy'])->name('api.pins.unlike');
});