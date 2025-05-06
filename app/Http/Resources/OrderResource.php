<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Currency;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $requestedCurrency = $request->input('Currency', 'UZS');
        
        // Konvertatsiya qilingan mahsulotlar
        $convertedProducts = $this->products->map(function($product) use ($requestedCurrency) {
            // Mahsulotning narxini olish va konvertatsiya qilish
            $convertedPrice = $product->price;
            if (in_array($requestedCurrency, ['RUB', 'USD'])) {
                $currencyRate = Currency::where('Ccy', $requestedCurrency)->value('Rate');
                if ($currencyRate) {
                    $convertedPrice = $product->price / $currencyRate;
                }
            }
            $convertedPrice = round($convertedPrice, 2);  // 2 raqamga yaxlitlash
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'image' => $product->url,
                'calory' => $product->calory,
                'slug' => $product->slug,
                'price' => $convertedPrice,
                'currency' => $requestedCurrency,
                'quantity' => $product->pivot->quantity,  // Pivot jadvalidan miqdorni olish
                'translations' => $product->translations->map(function($translation) {
                    return [
                        'id' => $translation->id,
                        'product_id' => $translation->product_id,
                        'locale' => $translation->locale,
                        'name' => $translation->name,
                        'description' => $translation->description,
                    ];
                }),
            ];
        });
    
        // Umumiy narxni konvertatsiya qilish
        $convertedTotalPrice = $this->total;
        if (in_array($requestedCurrency, ['RUB', 'USD'])) {
            $currencyRate = Currency::where('Ccy', $requestedCurrency)->value('Rate');
            if ($currencyRate) {
                $convertedTotalPrice = $this->total / $currencyRate;
            }
        }
        $convertedTotalPrice = round($convertedTotalPrice, 2);  // 2 raqamga yaxlitlash
        
        return [
            'id' => $this->id,
            'products' => $convertedProducts,
            'total' => $convertedTotalPrice,
            'currency' => $requestedCurrency,
        ];
    }
    
}
