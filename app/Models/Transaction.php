<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'customer_id',
        'staff_id',
        'total',
        'paid',
        'change',
        'discount',
        'grand_total',
        'payment_method',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->morphMany(TransactionItem::class, 'itemable');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
