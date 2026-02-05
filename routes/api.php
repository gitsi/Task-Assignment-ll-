<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/projects', [App\Http\Controllers\Api\ProjectController::class, 'index']);
Route::get('/tasks', [App\Http\Controllers\Api\TaskController::class, 'index']);
Route::get('/projects/{project}/tasks', [App\Http\Controllers\Api\TaskController::class, 'getByProject']);
Route::patch('/tasks/{task}/status', [App\Http\Controllers\Api\TaskController::class, 'updateStatus']);
