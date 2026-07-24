<?php

namespace App\Services;

use App\Models\BookCopy;

class BookCopyService extends BaseService
{
    protected $model = BookCopy::class;

    public function getByBook(int $bookId)
    {
        return BookCopy::where('book_id', $bookId)
            ->with('book')
            ->get();
    }

    public function createForBook(int $bookId, array $data): BookCopy
    {
        $data['book_id'] = $bookId;
        return BookCopy::create($data);
    }
}
