<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'barcode', 'condition', 'status'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'copy_id');
    }

    public function activeBorrowing()
    {
        return $this->borrowings()->where('status', 'Active');
    }

    public function isAvailable(): bool
    {
        return $this->status === 'Available';
    }
}
