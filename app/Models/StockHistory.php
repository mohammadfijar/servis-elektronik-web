<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'item_id',
        'old_stock',
        'new_stock',
        'reason',
    ];

    /**
     * Get the item that this stock history belongs to.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
