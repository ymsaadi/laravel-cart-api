<?php

namespace App\Http\Resources;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $discount = Discount::find($this->discount_code);
        $cartItems = $this->cartItems;

        $priceSum = 0;
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            $priceSum += ($product->price * $cartItem->quantity);
        }

        $tax = $priceSum * env('TAX');
        $discount_amount = $priceSum * $discount->percentage_value/100;

        return [
            'id' => $this->id,
            'cart item' => CartItemResource::collection($this->cartItems),
            'discount' => [
                'code' => $discount->code,
                'discount_amount' => $discount_amount,
                'value' => $discount->percentage_value,
            ],
            'summary' => [
                'discount_amount' => $discount_amount,
                'tax' => $tax,
                'total_price' => $priceSum + $tax - $discount_amount,
            ]
        ];
    }
}
