<?php

namespace App\Services;

use App\Models\InventoryItem;
use App\Models\InventoryLog;
use Illuminate\Support\Facades\DB;

class InventoryService extends BaseService
{
    public function getAll(array $filters = [])
    {
        $query = InventoryItem::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'ILIKE', "%{$search}%");
        }

        if (!empty($filters['low_stock'])) {
            $query->whereColumn('current_stock', '<=', 'minimum_stock');
        }

        return $query->orderBy('name')->paginate($filters['per_page'] ?? 15);
    }

    public function create(array $data): InventoryItem
    {
        return InventoryItem::create($data);
    }

    public function getById(int $id): InventoryItem
    {
        return InventoryItem::findOrFail($id);
    }

    public function update(int $id, array $data): bool
    {
        $item = $this->getById($id);
        return $item->update($data);
    }

    public function delete(int $id): bool
    {
        $item = $this->getById($id);
        return $item->delete();
    }

    public function restock(int $itemId, int $quantity, string $remarks = null): InventoryItem
    {
        return DB::transaction(function () use ($itemId, $quantity, $remarks) {
            $item = $this->getById($itemId);
            
            $item->increment('current_stock', $quantity);

            InventoryLog::create([
                'inventory_item_id' => $itemId,
                'quantity_change' => $quantity,
                'movement_type' => 'Restock',
                'remarks' => $remarks,
                'recorded_at' => now(),
            ]);

            return $item->fresh();
        });
    }

    public function getLogs(int $itemId = null, array $filters = [])
    {
        $query = InventoryLog::with('inventoryItem');

        if ($itemId) {
            $query->where('inventory_item_id', $itemId);
        }

        if (!empty($filters['movement_type'])) {
            $query->where('movement_type', $filters['movement_type']);
        }

        return $query->orderBy('recorded_at', 'desc')->paginate($filters['per_page'] ?? 15);
    }
}
