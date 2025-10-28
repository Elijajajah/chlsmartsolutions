<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'priority',
        'description',
        'customer_name',
        'customer_phone',
        'status',
        'user_id',
        'expiry_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityLog()
    {
        return $this->hasOne(ActivityLog::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
