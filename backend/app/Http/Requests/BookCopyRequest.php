<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCopyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barcode' => ['required', 'string', 'max:50', 'unique:book_copies,barcode,' . $this->route('id')],
            'condition' => ['required', 'string', 'in:New,Good,Fair,Poor'],
            'status' => ['nullable', 'string', 'in:Available,Borrowed,Damaged,Lost'],
        ];
    }
}
