<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'cart_id',
        'email',
        'address',
        'payment_method',
        'card_number',
        'total_amount',
    ];


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}