<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
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



Route::middleware(['guest'])->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [RegisterController::class, 'login']);
});
Route::middleware(['admin'])->group(function () {
    Route::post('/create', [PostController::class, 'create']);
    Route::post('/update/{id}', [PostController::class, 'update']);
    Route::post('/read', [PostController::class, 'read']);
    Route::post('/delete/{id}', [PostController::class, 'delete']);
    });
