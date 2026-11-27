<?php
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/feed');
require __DIR__ . '/web/auth.php';
require __DIR__ . '/web/content.php';
require __DIR__ . '/web/feed.php';