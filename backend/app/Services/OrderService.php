<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class OrderService extends BaseService
{
    public function getAll(array $filters = [])
    {
        $query = Order::with(['items.menuItem', 'payment']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'ILIKE', "%{$search}%")
                  ->orWhere('customer_name', 'ILIKE', "%{$search}%");
            });
        }

        return $query->orderBy('order_date', 'desc')->paginate($filters['per_page'] ?? 15);
    }

    public function create(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            // Calculate totals
            $subtotal = 0;
            $orderItems = [];

            foreach ($data['items'] as $item) {
                $menuItem = MenuItem::findOrFail($item['menu_item_id']);
                $itemSubtotal = $menuItem->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                $orderItems[] = [
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $menuItem->price,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $discount = $data['discount'] ?? 0;
            $totalAmount = $subtotal - $discount;

            // Create order
            $order = Order::create([
                'order_number' => $this->generateOrderNumber(),
                'customer_name' => $data['customer_name'],
                'status' => 'Completed',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total_amount' => $totalAmount,
            ]);

            // Create order items
            foreach ($orderItems as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }

            // Create payment (Cash only)
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'Cash',
                'amount' => $totalAmount,
                'payment_status' => 'Paid',
                'payment_date' => now(),
            ]);

            return $order->load(['items.menuItem', 'payment']);
        });
    }

    public function getById(int $id): Order
    {
        return Order::with(['items.menuItem', 'payment'])->findOrFail($id);
    }

    public function update(int $id, array $data): bool
    {
        $order = $this->getById($id);
        return $order->update($data);
    }

    public function delete(int $id): bool
    {
        $order = $this->getById($id);
        return $order->delete();
    }

    private function generateOrderNumber(): string
    {
        $prefix = 'ORD-';
        $date = now()->format('Ymd');
        $count = Order::whereDate('created_at', today())->count() + 1;
        return $prefix . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
