<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_id',
        'user_id',
        'customer_name',
        'total_amount',
        'payment_method',
        'type',
        'tax',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productSerials()
    {
        return $this->belongsToMany(ProductSerial::class, 'order_product_serial')
            ->withTimestamps();
    }
}
