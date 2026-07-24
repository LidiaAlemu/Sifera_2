<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

// Public auth routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/staff-login', [AuthController::class, 'staffLogin']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/borrowings', [BorrowingController::class, 'index']);
    Route::post('/borrowings', [BorrowingController::class, 'store']);
    Route::get('/borrowings/my', [BorrowingController::class, 'myBorrowings']);
    Route::get('/borrowings/{id}', [BorrowingController::class, 'show']);
    Route::put('/borrowings/{id}/return', [BorrowingController::class, 'return']);
});

// Public read routes
Route::get('/categories', [BookCategoryController::class, 'index']);
Route::get('/categories/{id}', [BookCategoryController::class, 'show']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/books/{bookId}/copies', [BookCopyController::class, 'index']);
Route::get('/books/{bookId}/copies/{id}', [BookCopyController::class, 'show']);
Route::get('/inventory', [InventoryController::class, 'index']);
Route::get('/inventory/{id}', [InventoryController::class, 'show']);
Route::get('/inventory/{itemId}/logs', [InventoryController::class, 'logs']);
Route::get('/inventory-logs', [InventoryController::class, 'logs']);

// Management routes (no auth middleware for now - easy testing)
Route::post('/categories', [BookCategoryController::class, 'store']);
Route::put('/categories/{id}', [BookCategoryController::class, 'update']);
Route::delete('/categories/{id}', [BookCategoryController::class, 'destroy']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
Route::post('/books/{bookId}/copies', [BookCopyController::class, 'store']);
Route::put('/books/{bookId}/copies/{id}', [BookCopyController::class, 'update']);
Route::delete('/books/{bookId}/copies/{id}', [BookCopyController::class, 'destroy']);
Route::post('/inventory', [InventoryController::class, 'store']);
Route::put('/inventory/{id}', [InventoryController::class, 'update']);
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy']);
Route::post('/inventory/{id}/restock', [InventoryController::class, 'restock']);
