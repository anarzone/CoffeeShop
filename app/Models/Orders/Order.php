<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_PAID = 2;

    protected $fillable = [
        'customer_id',
        'status',
        'shipping_address',
        'shipping_country',
        'shipping_city',
        'status',
        'subtotal',
        'delivery',
        'total',
        'note',
    ];
}
