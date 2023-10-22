<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('items', [ItemController::class, 'index']);

Route::apiResource('cart', CartController::class);

Route::post('place-order/{customer}', [OrderController::class, 'store']);