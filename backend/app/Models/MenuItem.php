<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'image_url', 'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function menuItemInventory()
    {
        return $this->hasMany(MenuItemInventory::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'Available';
    }
}
