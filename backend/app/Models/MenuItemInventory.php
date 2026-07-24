<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemInventory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'menu_item_id', 'inventory_item_id', 'quantity_required',
    ];

    protected $casts = [
        'quantity_required' => 'decimal:2',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }
}
