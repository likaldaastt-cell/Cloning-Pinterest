<?php
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => response()->json(['status' => 'ok']));
require __DIR__ . '/api/auth.php';
require __DIR__ . '/api/content.php';
require __DIR__ . '/api/feed.php';