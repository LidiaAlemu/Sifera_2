<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $orders = $this->service->getAll($request->all());
        return ApiResponse::success($orders);
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $order = $this->service->create($request->validated());
        return ApiResponse::created($order, 'Order created successfully');
    }

    public function show(int $id): JsonResponse
    {
        $order = $this->service->getById($id);
        return ApiResponse::success($order);
    }

    public function update(OrderRequest $request, int $id): JsonResponse
    {
        $this->service->update($id, $request->validated());
        return ApiResponse::success($this->service->getById($id), 'Order updated');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return ApiResponse::success(null, 'Order deleted');
    }
}
