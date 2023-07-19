<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('pemiliki-postingan');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('pemiliki-postingan');

    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware('pemiliki-komentar');;
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware('pemiliki-komentar');;
});

Route::post('/register', [AuthenticationController::class, 'register']);

Route::post('/login', [AuthenticationController::class, 'login']);
