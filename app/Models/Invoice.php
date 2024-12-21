<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'pemeriksa',
        'user_id',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}
