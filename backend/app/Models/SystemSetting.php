<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'setting_key', 'setting_value', 'description', 'updated_by_id',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
