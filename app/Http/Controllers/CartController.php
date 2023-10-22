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
    protected $customer;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->customer = Customer::first();
    }

    public function index()
    {
        return new CartCollection(Cart::with('item')->whereCustomerId($this->customer->id)->get());
    }

    public function store(CreateCartRequest $request)
    {
        $validated = $request->validated();

        $cart = Cart::where('customer_id', $this->customer->id)
            ->where('item_id', $validated['item_id'])
            ->first();

        if ($cart) {
            $this->cartService->updateQuantity($cart, $validated['quantity']);
            return $cart;
        } 
        return response()->json([
            'data' => $this->customer->carts()->create($validated)
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
