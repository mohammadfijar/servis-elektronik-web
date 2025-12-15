<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ← Tambahkan ini
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
