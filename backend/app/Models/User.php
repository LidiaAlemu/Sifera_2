<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Role checking methods
    public function isAdmin(): bool
    {
        return $this->role === 'Admin';
    }

    public function isManager(): bool
    {
        return $this->role === 'Manager' || $this->role === 'Admin';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'Customer';
    }

    // Relationships
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by_id');
    }
}
