<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request)
    {
        $customer = Customer::first();

        if ($customer->carts()->count() == 0) {
            return response()->json([
                'data' => [],
                'message' => 'No item found in shopping cart',
            ], Response::HTTP_BAD_REQUEST);
        }

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
                'success' => true,
                'order' => $order,
                'store_credit' => $customer->store_credit
            ], Response::HTTP_CREATED);

        });

    }
}
