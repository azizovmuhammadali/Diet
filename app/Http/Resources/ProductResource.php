<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $requestedCurrency = $request->input('Currency', 'UZS');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->url,
            'calory' => $this->calory,
            'slug' => $this->slug,
            'price' => $this->price,
            'currency' => $requestedCurrency,
            'translations' => ProductTranslationResource::collection($this->whenLoaded('translations')),
        ];
    }
}
