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
        'total_amount',
        'type',
        'status',
        'expiry_date',
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
