<?php

namespace App\Services;

use App\Models\Book;

class BookService extends BaseService
{
    protected $model = Book::class;

    public function getAll(array $filters = [])
    {
        $query = Book::with('category')
            ->withCount('copies')
            ->withCount(['copies as available_copies_count' => function ($q) {
                $q->where('status', 'Available');
            }]);

        // Search filter
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ILIKE', "%{$search}%")
                  ->orWhere('author', 'ILIKE', "%{$search}%")
                  ->orWhere('isbn', 'ILIKE', "%{$search}%");
            });
        }

        // Category filter
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        return $query->orderBy('title')->paginate($filters['per_page'] ?? 15);
    }

    public function getById(int $id)
    {
        return Book::with('category')
            ->with('copies')
            ->withCount('copies')
            ->withCount(['copies as available_copies_count' => function ($q) {
                $q->where('status', 'Available');
            }])
            ->findOrFail($id);
    }
}
