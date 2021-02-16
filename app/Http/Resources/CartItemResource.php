<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tax = Product::findOrFail($this->product_id)->price * env('TAX') * $this->quantity;

        return [
            'row_id' => $this->id,
            'product' => new ProductResource(Product::findOrFail($this->product_id)),
            'quantity' => $this->quantity,
            'tax' => $tax,
            'subtotal' => $tax + Product::findOrFail($this->product_id)->price * $this->quantity,
        ];
    }
}
