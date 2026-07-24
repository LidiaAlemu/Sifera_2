<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'event_date', 'start_time',
        'end_time', 'location', 'image_url', 'price',
        'max_participants', 'status', 'hidden', 'created_by_id',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'price' => 'decimal:2',
        'max_participants' => 'integer',
        'hidden' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function isFull(): bool
    {
        return $this->registrations()->where('status', 'Registered')->count() >= $this->max_participants;
    }
}
