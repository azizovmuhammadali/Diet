<?php

namespace App\Http\Controllers\V1\api\User;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Interfaces\Services\ProductServiceInterface;

class ProductController extends Controller
{
    use ResponseTrait;
     
    public function __construct(protected ProductServiceInterface $productServiceInterface){}
     public function index()
     {
         $products = $this->productServiceInterface->index();
         return $this->success(ProductResource::collection($products),__('successes.product.all'));
     }
     public function show(string $id)
     {
        $product = $this->productServiceInterface->show($id);
        return $this->success(new ProductResource($product),__('successes.product.show'));
     }
}
