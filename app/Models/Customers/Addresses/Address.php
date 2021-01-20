<?php

namespace App\Models\Customers\Addresses;

use App\Models\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'address',
        'country',
        'city',
        'phone',
        'customer_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
