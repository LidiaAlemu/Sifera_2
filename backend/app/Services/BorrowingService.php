<?php

namespace App\Services;

use App\Models\BookCopy;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;

class BorrowingService extends BaseService
{
    protected $model = Borrowing::class;

    public function getAll(array $filters = [])
    {
        $query = Borrowing::with(['user', 'copy.book']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        return $query->orderBy('borrowed_at', 'desc')->paginate($filters['per_page'] ?? 15);
    }

    public function getMyBorrowings(int $userId)
    {
        return Borrowing::with(['copy.book'])
            ->where('user_id', $userId)
            ->orderBy('borrowed_at', 'desc')
            ->get();
    }

    public function borrow(int $copyId, int $userId, int $borrowedBy, array $data): Borrowing
    {
        return DB::transaction(function () use ($copyId, $userId, $borrowedBy, $data) {
            $copy = BookCopy::findOrFail($copyId);

            if ($copy->status !== 'Available') {
                throw new \Exception('This book copy is not available for borrowing.');
            }

            // Create borrowing
            $borrowing = Borrowing::create([
                'user_id' => $userId,
                'copy_id' => $copyId,
                'borrowed_by' => $borrowedBy,
                'due_date' => $data['due_date'],
                'due_time' => $data['due_time'] ?? null,
                'amount_charged' => $data['amount_charged'] ?? 0,
                'status' => 'Active',
            ]);

            // Update copy status
            $copy->update(['status' => 'Borrowed']);

            return $borrowing->load(['user', 'copy.book']);
        });
    }

    public function return(int $borrowingId, int $returnedBy): Borrowing
    {
        return DB::transaction(function () use ($borrowingId, $returnedBy) {
            $borrowing = Borrowing::findOrFail($borrowingId);

            if ($borrowing->status !== 'Active') {
                throw new \Exception('This borrowing is not active.');
            }

            // Update borrowing
            $borrowing->update([
                'returned_at' => now(),
                'returned_by' => $returnedBy,
                'status' => 'Returned',
            ]);

            // Update copy status
            $borrowing->copy->update(['status' => 'Available']);

            return $borrowing->load(['user', 'copy.book', 'returnedBy']);
        });
    }
}
