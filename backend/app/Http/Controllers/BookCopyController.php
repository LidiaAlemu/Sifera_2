<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\BookCopyRequest;
use App\Services\BookCopyService;
use Illuminate\Http\JsonResponse;

class BookCopyController extends Controller
{
    public function __construct(
        private BookCopyService $service
    ) {}

    public function index(int $bookId): JsonResponse
    {
        $copies = $this->service->getByBook($bookId);
        return ApiResponse::success($copies);
    }

    public function store(BookCopyRequest $request, int $bookId): JsonResponse
    {
        $copy = $this->service->createForBook($bookId, $request->validated());
        return ApiResponse::created($copy, 'Book copy added');
    }

    public function show(int $bookId, int $id): JsonResponse
    {
        $copy = $this->service->getById($id);
        return ApiResponse::success($copy->load('book'));
    }

    public function update(BookCopyRequest $request, int $bookId, int $id): JsonResponse
    {
        $this->service->update($id, $request->validated());
        return ApiResponse::success($this->service->getById($id), 'Copy updated');
    }

    public function destroy(int $bookId, int $id): JsonResponse
    {
        $this->service->delete($id);
        return ApiResponse::success(null, 'Copy deleted');
    }
}
