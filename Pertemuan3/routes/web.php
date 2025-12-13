<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

// Router untuk memanggil method di PostController
Route::get('posts', [PostController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);