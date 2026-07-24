<?php

namespace App\Services;

use App\Models\MenuItem;

class MenuItemService extends BaseService
{
    public function getAll(array $filters = [])
    {
        $query = MenuItem::query();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'ILIKE', "%{$search}%");
        }

        return $query->orderBy('name')->paginate($filters['per_page'] ?? 15);
    }

    public function create(array $data): MenuItem
    {
        return MenuItem::create($data);
    }

    public function getById(int $id): MenuItem
    {
        return MenuItem::findOrFail($id);
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

    public function getAvailable(): array
    {
        return MenuItem::where('status', 'Available')
            ->orderBy('name')
            ->get()
            ->toArray();
    }
}
