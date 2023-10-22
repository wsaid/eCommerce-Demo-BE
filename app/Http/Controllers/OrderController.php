<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Customer $customer, CreateOrderRequest $request)
    {
        $total = $customer->carts->sum('final_price');

        $validated = $request->validated();

        return DB::transaction(function () use ($customer, $total, $validated) {
            if ($customer->store_credit < $total) {
                return response()->json([
                    'data' => [],
                    'message' => 'Insufficient store credit',
                ], Response::HTTP_BAD_REQUEST);
            }

            // Deduct the total from the store credit
            $customer->store_credit -= $total;
            $customer->save();

            // Create a new order
            $order = $customer->orders()->create(array_merge($validated, ['total' => $total]));

            // Clear the customer's cart
            $customer->carts()->delete();

            return response()->json([
                'store_credit' => $customer->store_credit
            ], Response::HTTP_CREATED);

        });

    }
}