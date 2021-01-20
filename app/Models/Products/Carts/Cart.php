<?php

namespace App\Models\Products\Carts;

use App\Models\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id'
    ];

    public function items(){
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
