<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownPayment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'path',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
