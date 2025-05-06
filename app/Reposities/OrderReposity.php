<?php

namespace App\Reposities;

use App\Filters\ProductFilter;
use App\Models\User;
use App\Models\Order;
use App\Notifications\OrderUpdatedNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderCreatedNotification;
use App\Interfaces\Reposities\OrderReposityInterface;
use App\Models\Product;
use App\Notifications\OrderDeletedNotification;

class OrderReposity implements OrderReposityInterface
{
   public function Orders()
   {
    return Auth::user()->orders()->with('products')->get();
   }
   public function create($data)
   {
       $order = new Order();
       $order->user_id = Auth::id();
       $order->save();
   
       $totalPrice = 0;
   
       // `OrderDTO`dan qiymatlarni olish
       $productIds = $data->product_id; // DTO-dan product_id
       $quantities = $data->quantity; // DTO-dan quantity
   
       foreach ($productIds as $key => $product_id) {
           $quantity = $quantities[$key]; // Quantityni olish
           $product = Product::findOrFail($product_id);
           $price = $product->price;
   
           // Har bir product va quantity attach qilinadi
           $order->products()->attach($product_id, ['quantity' => $quantity]);
   
           // Narx hisoblanadi
           $totalPrice += $price * $quantity;
       }
   
       // Total price saqlanadi
       $order->total = $totalPrice;
       $order->save();
   
       // Adminlarga bildirishnoma
       $admins = User::where('role', 'admin')->get();
       foreach ($admins as $admin) {
           $admin->notify(new OrderCreatedNotification($order));
       }
   
       return $order->load('products');
   }
   

   public function getById($id){
   $order = Order::findOrFail($id);
   return $order->load('products');
   }
   public function findById($id, $orderDTO)
   {
       $order = Order::findOrFail($id);
       $order->products()->detach(); 
       foreach ($orderDTO->product_id as $key => $productId) {
           $quantity = $orderDTO->quantity[$key];
           $order->products()->attach($productId, ['quantity' => $quantity]);
       }
       $totalPrice = 0;
       foreach ($orderDTO->product_id as $key => $productId) {
           $product = Product::findOrFail($productId);
           $quantity = $orderDTO->quantity[$key];
           $totalPrice += $product->price * $quantity;
       }
       $order->total = $totalPrice;
       $order->save();
       $admins = User::where('role', 'admin')->get();
       foreach ($admins as $admin) {
           $admin->notify(new OrderUpdatedNotification($order));
       }
       return $order->load('products');
   }
   
   public function destroy($id){
      $order = Order::findOrFail($id);
      $order->delete();
      $admins = User::where('role', 'admin')->get();
      foreach ($admins as $admin) {
        $admin->notify(new OrderDeletedNotification($order));
    }
   }
   public function filter($filter){
    $filters = [];  // Filters arrayini yaratish
    if ($filter) {
        $filters['calory'] = $filter;  // 'name' filtri sifatida $searchni kiritish
    }
    $filterTpe = new ProductFilter();
    $query = Product::query();
    $filteredProducts = $filterTpe->apply($query, $filters)->get();
    return $filteredProducts;
   }
}

