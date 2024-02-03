<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth-user')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);

    Route::get('/project/create', [ProjectController::class, 'create']);
    Route::post('/project/store', [ProjectController::class, 'store']);

    Route::get('/project/task/create', [TaskController::class, 'create']);
    Route::post('/project/{project}/task', [TaskController::class, 'store']);

    // Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']);
    // Route::post('/blogs/{blog:slug}/subscribe', [subscribeController::class, 'subscribe'])->name('blogs.toggle');
    // Route::delete('/blogs/comments/delete/{comment}', [CommentController::class, 'delete'])->middleware('can:delete,comment');
    // Route::get('/blogs/comments/edit/{comment}', [CommentController::class, 'edit'])->middleware('can:edit,comment');
    // Route::put('/blogs/comments/update/{comment}', [CommentController::class, 'update'])->middleware('can:edit,comment');
    // Route::post('/subscribeNewBlogs', [subscribeController::class, 'subscribeNewBlogs']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'loginStore']);
});
