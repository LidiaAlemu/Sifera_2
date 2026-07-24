<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'isbn' => ['required', 'string', 'max:20'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:book_categories,id'],
            'publication_year' => ['nullable', 'integer', 'min:1000', 'max:' . date('Y')],
            'language' => ['nullable', 'string', 'max:50'],
            'edition' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'shelf_location' => ['nullable', 'string', 'max:50'],
            'cover_image' => ['nullable', 'string', 'max:255'],
        ];
    }
}
