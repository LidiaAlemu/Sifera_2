<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\BookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        private BookService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $books = $this->service->getAll($request->all());
        return ApiResponse::success($books);
    }

    public function store(BookRequest $request): JsonResponse
    {
        $book = $this->service->create($request->validated());
        return ApiResponse::created($book, 'Book created');
    }

    public function show(int $id): JsonResponse
    {
        $book = $this->service->getById($id);
        return ApiResponse::success($book);
    }

    public function update(BookRequest $request, int $id): JsonResponse
    {
        $this->service->update($id, $request->validated());
        return ApiResponse::success($this->service->getById($id), 'Book updated');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return ApiResponse::success(null, 'Book deleted');
    }
}
