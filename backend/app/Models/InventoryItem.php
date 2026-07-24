<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'current_stock', 'minimum_stock',
        'reorder_level', 'unit',
    ];

    public function logs()
    {
        return $this->hasMany(InventoryLog::class);
    }

    public function menuItemInventory()
    {
        return $this->hasMany(MenuItemInventory::class);
    }

    public function isLowStock(): bool
    {
        return $this->current_stock <= $this->minimum_stock;
    }
}
