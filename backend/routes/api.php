<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login',    [AuthController::class, 'login']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tasks', TaskController::class);
        Route::post('tasks/reorder', [TaskController::class, 'reorder']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::middleware(['auth:sanctum', 'is_admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
    });
});