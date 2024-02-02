<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
