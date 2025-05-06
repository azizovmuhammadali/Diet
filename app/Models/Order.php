<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'user_id',
    'quantity',
    'status',
  ];
  public function products()
{
    return $this->belongsToMany(Product::class, 'order_products')->withPivot('quantity');
}

  public function user(){
    return $this->belongsTo(User::class);
  }
}
