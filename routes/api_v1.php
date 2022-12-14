<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('tasks', TasksController::class);
    Route::post('tasks/fill', [TasksController::class, 'fill'])->name('tasks.fill');
    Route::patch('tasks/{task}/status',[TasksController::class, 'status'])->name('tasks.status');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
