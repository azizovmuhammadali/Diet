<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'products' => ProductResource::collection($this->whenLoaded('products'))->map(function ($product) {
                // Har bir mahsulot uchun quantityni olish
                $product->quantity = $product->pivot->quantity;
                return $product;
            }),
        ];
    }
}
