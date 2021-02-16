<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Discount;
use Illuminate\Http\Request;

// I didn't make any validation.
class CartController extends Controller
{
    // Get All Carts
    public function index() {
        return CartResource::collection(Cart::all());
    }

    // Create a Cart
    public function store(Request $request) {
        $cart = Cart::create([]);
    }

    // Retrieve a Cart
    public function getCart($id) {
        // $cart = Cart::find($id);
        // return response()->json([
        //     'id' => $id,
        //     'content' => CartItemResource::collection($cart->cartItems),
        // ]);
        return new CartResource(Cart::findOrFail($id));
    }

    // Add a CartItem To a Cart
    public function addItemToCart($id, Request $request) {
        $cart = Cart::find($id);
        $cartItem = CartItem::create([
            'cart_id' => $id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
    }

    // Update a CartItem in a Cart
    public function updateCartItem($id, Request $request) {
        if ($request->quantity == 0) {
            $this->deleteItemFromCart($id, $request);
            return 0;
        }
        $cartItem = CartItem::find($request->row_id);
        $cartItem->product_id = $request->product_id;
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
    }

    // Deleting an Item from a Cart
    public function deleteItemFromCart($id, Request $request) {
        CartItem::destroy($request->row_id);
    }

    // Attach Discount to Cart
    public function attachDiscount($id, Request $request) {
        $discount = Discount::find($request->code);
        $cart = Cart::find($id);
        $cart->discount_code = $request->code;
        $cart->save();
    }
}
