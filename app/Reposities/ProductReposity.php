<?php

namespace App\Reposities;

use App\Interfaces\Reposities\ProductReposityInterface;
use App\Models\Product;

class ProductReposity implements ProductReposityInterface
{
      public function Products(){
   $products = Product::with('translations')->get();
   return $products;
      }
      public function create($data){
      $product = new Product();
      $product->fill($data['translations']);
      $product->image = $data['image'];
      $product->calory = $data['calory'];
      $product->slug = $data['slug'];
      $product->save();
      return $product->load('translations');
      }
      public function getById($id){
    $product = Product::where('slug',$id)->firstOrFail();
    return $product->load('translations');
      }
      public function findById($id, $data){
        $product =  Product::findOrFail($id);
        $product->fill($data['translations']);
        $product->image = $data['image'] ?? $product->image;
        $product->calory = $data['calory'] ?? $product->calory;
        $product->slug = $data['slug'] ?? $product->slug;
        $product->save();
        return $product->load('translations');
      }
      public function destroy($id){
        $product =  Product::findOrFail($id);
        $product->delete();
      }
}
