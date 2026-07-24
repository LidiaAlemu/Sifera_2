<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Requests\ReturnBookRequest;
use App\Services\BorrowingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function __construct(
        private BorrowingService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $borrowings = $this->service->getAll($request->all());
        return ApiResponse::success($borrowings);
    }

    public function store(BorrowBookRequest $request): JsonResponse
    {
        $user = auth()->user();
        $borrowing = $this->service->borrow(
            $request->copy_id,
            $request->user_id ?? $user->id,
            $user->id,
            $request->validated()
        );

        return ApiResponse::created($borrowing, 'Book borrowed successfully');
    }

    public function show(int $id): JsonResponse
    {
        $borrowing = $this->service->getById($id);
        return ApiResponse::success($borrowing->load(['user', 'copy.book', 'returnedBy', 'borrowedBy']));
    }

    public function return(int $id, ReturnBookRequest $request): JsonResponse
    {
        $borrowing = $this->service->return($id, auth()->user()->id);
        return ApiResponse::success($borrowing, 'Book returned successfully');
    }

    public function myBorrowings(): JsonResponse
    {
        $borrowings = $this->service->getMyBorrowings(auth()->user()->id);
        return ApiResponse::success($borrowings);
    }
}
