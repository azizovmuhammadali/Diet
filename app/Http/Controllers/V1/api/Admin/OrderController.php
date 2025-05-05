<?php

namespace App\Http\Controllers\V1\api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStatusRequest;
use App\Http\Resources\OrderStatusResource;
use App\Models\Order;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponseTrait;
    public function status(OrderStatusRequest $orderStatusRequest,$id){
        $order = Order::findOrFail($id);
        $order->status = $orderStatusRequest->status;
        $order->save();
        return $this->success(new OrderStatusResource($order));
    }
}
