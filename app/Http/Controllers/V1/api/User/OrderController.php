<?php

namespace App\Http\Controllers\V1\api\User;

use App\DTO\OrderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Interfaces\Services\OrderServiceInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
use ResponseTrait;
   public function __construct(protected OrderServiceInterface $orderServiceInterface){}
    public function index()
    {
        $orders  = $this->orderServiceInterface->index();
        return $this->success(OrderResource::collection($orders),__('successes.order.all'));
    }

    public function store(OrderStoreRequest $request)
    {
        $orderDTO = new OrderDTO($request->product_id,$request->quantity);
        $order = $this->orderServiceInterface->store($orderDTO);
        return $this->success(new OrderResource($order),__('successes.order.create'));
    }

    public function show(string $id)
    {
        $order = $this->orderServiceInterface->show($id);
        if ($order->user_id !== auth()->id()) {
            return $this->error(__('errors.user.user'), 403);
        }
        return $this->success(new OrderResource($order),__('successes.order.show'));
    }

    public function update(OrderUpdateRequest $request, string $id)
    {
        $orderDTO = new OrderDTO($request->product_id,$request->quantity);
        $order = $this->orderServiceInterface->update($id,$orderDTO);
        if ($order->user_id !== auth()->id()) {
            return $this->error(__('errors.user.user'), 403);
        }
        return $this->success(new OrderResource($order),__('successes.order.update'));
    }

    public function destroy(string $id)
    {
        $order = $this->orderServiceInterface->show($id); // Avval buyurtmani olamiz
    
        if ($order->user_id !== auth()->id()) {
            return $this->error(__('errors.user.user'), 403);
        }
    
        $this->orderServiceInterface->delete($id); // Keyin o'chiramiz
        return $this->success([], __('successes.order.delete'));
    }
      public function filter(Request $request){
        $order = $this->orderServiceInterface->search($request->all());
        return $this->success(ProductResource::collection($order));
      }
}
