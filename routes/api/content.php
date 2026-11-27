<?php

use App\Http\Controllers\Api\BoardController;
use App\Http\Controllers\Api\PinController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // ->names('api.boards') mencegah nama route bentrok dengan route web boards.*
    Route::apiResource('boards', BoardController::class)->names('api.boards');
    Route::apiResource('pins', PinController::class)->except(['index'])->names('api.pins');
});