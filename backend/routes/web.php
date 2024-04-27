<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/test', 'test');

Route::middleware('auth-user')->group(function () {

    Route::post('/update-task-positions', [TaskController::class, 'updateTaskPositions']);


    Route::get('/profile/{user}/edit', [User::class, 'show']);
    Route::patch('/profile/{user}/update', [AuthController::class, 'update']);

    Route::post('/task/toggle-completed/{task}', [TaskController::class, 'toggleCompleted']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->middleware('can:view_Project,project');
    Route::get('/projects/{project}/kanbanBoard', [KanbanController::class, 'showkanban']);




    Route::get('/projects/{project}/videoCallSession', [MeetingController::class, 'showVideoCallSession']);

    Route::get('/projects/{project}/meeting', [MeetingController::class, 'showMeeting']);
    Route::post('/project/{project}/meeting', [MeetingController::class, 'store']);




    // Route::get('/project/create', [ProjectController::class, 'create']);
    Route::post('/project/store', [ProjectController::class, 'store']);
    Route::patch('/project/{project}/update', [ProjectController::class, 'update']);
    Route::delete('/project/{project}/delete', [ProjectController::class, 'destroy']);

    Route::patch('/task/{task}/update', [TaskController::class, 'update']);
    Route::delete('/task/{task}/delete', [TaskController::class, 'destroy']);

    Route::post('/project/{project}/task', [TaskController::class, 'store']);

    Route::post('/project/{project}/member', [ProjectController::class, 'storeMembers']);

    Route::post('/task/{task}/assign-members', [TaskController::class, 'assignMembers'])->name('task.assignMembers');

    Route::get('/user/tasks', [TaskController::class, 'index']);


    Route::post('/columns/store', [ColumnController::class, 'storeColumn'])->name('columns.store');

    // Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']);
    // Route::post('/blogs/{blog:slug}/subscribe', [subscribeController::class, 'subscribe'])->name('blogs.toggle');
    // Route::delete('/blogs/comments/delete/{comment}', [CommentController::class, 'delete'])->middleware('can:delete,comment');
    // Route::get('/blogs/comments/edit/{comment}', [CommentController::class, 'edit'])->middleware('can:edit,comment');
    // Route::put('/blogs/comments/update/{comment}', [CommentController::class, 'update'])->middleware('can:edit,comment');
    // Route::post('/subscribeNewBlogs', [subscribeController::class, 'subscribeNewBlogs']);
});

Route::get('/register', [AuthController::class, 'create']);
Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'loginStore']);
});