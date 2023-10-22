<?php

namespace App\Services;

use App\Models\Cart;

class CartService {

    public function updateQuantity(Cart $cart, $quantity)
    {
        if ($cart->quantity + $quantity > 10) {
            throw new \InvalidArgumentException('Maximum quantity for the same item is 10.');
        }

        // won't trigger Model event
        // $cart->increment('quantity', $quantity);

        $cart->quantity += $quantity;
        $cart->save();
    }

}