<?php

namespace App\Services;

use App\Models\BookCategory;

class BookCategoryService extends BaseService
{
    protected $model = BookCategory::class;

    public function getAll(array $filters = [])
    {
        return BookCategory::withCount('books')
            ->orderBy('name')
            ->get();
    }
}
