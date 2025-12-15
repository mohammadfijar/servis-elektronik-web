<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'items_id',
        'jumlah',
        'total_harga',
    ];

    /**
     * Relasi dengan Produk
     */
        public function produk()
        {
            return $this->belongsTo(Item::class, 'items_id');
        }
}