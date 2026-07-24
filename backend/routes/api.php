<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public auth routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/staff-login', [AuthController::class, 'staffLogin']);

// Protected auth routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// Book Categories
Route::get('/categories', [BookCategoryController::class, 'index']);
Route::post('/categories', [BookCategoryController::class, 'store']);
Route::get('/categories/{id}', [BookCategoryController::class, 'show']);
Route::put('/categories/{id}', [BookCategoryController::class, 'update']);
Route::delete('/categories/{id}', [BookCategoryController::class, 'destroy']);

// Books
Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
