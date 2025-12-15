<?php

// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'customer_id',
        'staff_id',
        'description',
        'diagnosis',
        'action_taken',
        'service_fee',
        'service_date',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    // Morph relation to transaction items
    public function transactionItems()
    {
        return $this->morphMany(TransactionItem::class, 'itemable');
    }
}
