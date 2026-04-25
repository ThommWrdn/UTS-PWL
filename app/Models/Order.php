<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    const STATUS_PENDING   = 'pending';
    const STATUS_DELIVERY  = 'delivery';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_SUCCESS   = 'success';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
