<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Customer;
use App\Services\CartService;
use Illuminate\Http\Response;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show(Customer $customer)
    {
        return new CartCollection(Cart::with('item')->whereCustomerId($customer->id)->get());
    }

    public function store(Customer $customer, CreateCartRequest $request)
    {
        $validated = $request->validated();

        $cart = Cart::where('customer_id', $customer->id)
            ->where('item_id', $validated['item_id'])
            ->first();

        if ($cart) {
            $this->cartService->updateQuantity($cart, $validated['quantity']);
            return $cart;
        } 
        return response()->json([
            'data' =>$customer->carts()->create($validated)
        ], Response::HTTP_CREATED);
    }

    public function update(Cart $cart, UpdateCartRequest $request)
    {   
        $validated = $request->validated();

        $cart->update($validated);

        return response()->json([
            'data' => $cart
        ], 200);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
    }
}
