<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'email',
    ];

    public function stockRequests()
    {
        return $this->hasMany(StockRequest::class);
    }
}
