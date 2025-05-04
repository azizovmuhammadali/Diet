<?php

namespace App\Http\Controllers\V1\api\Admin;

use App\DTO\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\Services\ProductServiceInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
 use ResponseTrait;
     
   public function __construct(protected ProductServiceInterface $productServiceInterface){}
    public function index()
    {
        $products = $this->productServiceInterface->index();
        return $this->success(ProductResource::collection($products),__('successes.product.all'));
    }

    public function store(ProductStoreRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        $productDTO = new ProductDTO($request->translations,$imagePath,$request->calory,$request->price);
        $product = $this->productServiceInterface->store($productDTO);
        return $this->success(new ProductResource($product),__('successes.product.create'));
    }


    public function show(string $id)
    {
       $product = $this->productServiceInterface->show($id);
       return $this->success(new ProductResource($product),__('successes.product.show'));
    }

    public function update(ProductUpdateRequest $request, string $id)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        $productDTO = new ProductDTO($request->translations,$imagePath,$request->calory,$request->price);
        $product = $this->productServiceInterface->update($id,$productDTO);
        return $this->success(new ProductResource($product),__('successes.product.update'));
    }

    public function destroy(string $id)
    {
        $product = $this->productServiceInterface->delete($id);
        return $this->success([],__('successes.product.delete'));
    }
}
