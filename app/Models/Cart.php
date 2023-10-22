<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['item'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Cart $cart) {
            $cart->final_price = $cart->item->price * $cart->quantity;
        });

        static::updating(function (Cart $cart) {
            $cart->final_price = $cart->item->price * $cart->quantity;
        });
    }
}
