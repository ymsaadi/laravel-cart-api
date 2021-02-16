<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    // Get all CartItems
    public function index() {
        return CartItemResource::collection(CartItem::all());
    }

    // Post a CartItem
    public function store(Request $request) {
        $cartItem = CartItem::create([

        ]);
    }
}
