<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\InventoryItemRequest;
use App\Http\Requests\RestockRequest;
use App\Services\InventoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        private InventoryService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $items = $this->service->getAll($request->all());
        return ApiResponse::success($items);
    }

    public function store(InventoryItemRequest $request): JsonResponse
    {
        $item = $this->service->create($request->validated());
        return ApiResponse::created($item, 'Inventory item created');
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->service->getById($id);
        return ApiResponse::success($item->load('logs'));
    }

    public function update(InventoryItemRequest $request, int $id): JsonResponse
    {
        $this->service->update($id, $request->validated());
        return ApiResponse::success($this->service->getById($id), 'Item updated');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return ApiResponse::success(null, 'Item deleted');
    }

    public function restock(RestockRequest $request, int $id): JsonResponse
    {
        $item = $this->service->restock(
            $id,
            $request->quantity,
            $request->remarks
        );

        return ApiResponse::success($item, 'Stock restocked successfully');
    }

    public function logs(Request $request, int $itemId = null): JsonResponse
    {
        $logs = $this->service->getLogs($itemId, $request->all());
        return ApiResponse::success($logs);
    }
}
