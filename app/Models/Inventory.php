<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stock',
        'stock_min_limit',
        'stock_max_limit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
