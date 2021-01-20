<?php

namespace App\Models\Customers;

use App\Models\Products\Carts\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Customer extends Model
{
    use HasFactory;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const PATH_PROFILE_PIC = 'profiles';

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];


    public function addresses(){
        return $this->hasMany(Customer::class,'customer_id');
    }

    public function cart(){
        return $this->hasOne(Cart::class, 'customer_id');
    }

}
