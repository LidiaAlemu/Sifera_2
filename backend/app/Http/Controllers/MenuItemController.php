<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\MenuItemRequest;
use App\Services\MenuItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function __construct(
        private MenuItemService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $items = $this->service->getAll($request->all());
        return ApiResponse::success($items);
    }

    public function store(MenuItemRequest $request): JsonResponse
    {
        $item = $this->service->create($request->validated());
        return ApiResponse::created($item, 'Menu item created');
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->service->getById($id);
        return ApiResponse::success($item);
    }

    public function update(MenuItemRequest $request, int $id): JsonResponse
    {
        $this->service->update($id, $request->validated());
        return ApiResponse::success($this->service->getById($id), 'Menu item updated');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return ApiResponse::success(null, 'Menu item deleted');
    }
}
