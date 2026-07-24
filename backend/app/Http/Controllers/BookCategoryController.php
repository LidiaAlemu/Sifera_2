<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\BookCategoryRequest;
use App\Services\BookCategoryService;
use Illuminate\Http\JsonResponse;

class BookCategoryController extends Controller
{
    public function __construct(
        private BookCategoryService $service
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->service->getAll();
        return ApiResponse::success($categories);
    }

    public function store(BookCategoryRequest $request): JsonResponse
    {
        $category = $this->service->create($request->validated());
        return ApiResponse::created($category, 'Category created');
    }

    public function show(int $id): JsonResponse
    {
        $category = $this->service->getById($id);
        return ApiResponse::success($category->load('books'));
    }

    public function update(BookCategoryRequest $request, int $id): JsonResponse
    {
        $this->service->update($id, $request->validated());
        return ApiResponse::success($this->service->getById($id), 'Category updated');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return ApiResponse::success(null, 'Category deleted');
    }
}
