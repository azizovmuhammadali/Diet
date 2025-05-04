<?php

namespace App\Reposities;

use App\Models\User;
use App\Models\Order;
use App\Notifications\OrderUpdatedNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderCreatedNotification;
use App\Interfaces\Reposities\OrderReposityInterface;
use App\Notifications\OrderDeletedNotification;

class OrderReposity implements OrderReposityInterface
{
   public function Orders()
   {
    return Auth::user()->orders()->with('products')->get();
   }
   public function create($data){
    $order = new Order();
    $order->user_id = Auth::id();
    $order->quantity = $data['quantity'];
    $order->save();
     $order->products()->attach($data['product_id']);
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
   public function findById($id, $data){
      $order = Order::findOrFail($id);
      $order->user_id = Auth::id();
      $order->quantity = $data['quantity'];
      $order->save();
     $order->products()->attach($data['product_id']);
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
}

