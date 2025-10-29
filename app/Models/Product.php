<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier',
        'original_price',
        'retail_price',
        'description',
        'name',
        'category_id',
        'min_limit',
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function serials()
    {
        return $this->hasMany(ProductSerial::class);
    }

    public function availableReservedCount()
    {
        return $this->serials()
            ->whereIn('status', ['available', 'reserved'])
            ->count();
    }

    public function availableCount()
    {
        return $this->serials()
            ->where('status', 'available')
            ->count();
    }
}
