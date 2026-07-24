<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'copy_id' => ['required', 'exists:book_copies,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'due_date' => ['required', 'date', 'after:today'],
            'due_time' => ['nullable', 'date_format:H:i'],
            'amount_charged' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
