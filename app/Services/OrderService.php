<?php

namespace App\Services;

use App\Models\Product;
use App\Interfaces\Services\OrderServiceInterface;
use App\Interfaces\Reposities\OrderReposityInterface;

class OrderService implements OrderServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected OrderReposityInterface $orderReposityInterface)
    {
        //
    }
    public function index(){
     return $this->orderReposityInterface->Orders();
    }
    public function store($orderDTO)
    {
        $data = [
            'product_id' => $orderDTO->product_id,
            'quantity' => $orderDTO->quantity,
        ];
        return $this->orderReposityInterface->create($data);
    }
    
    
    public function show($id){
     return $this->orderReposityInterface->getById($id);
    }
    public function update($id, $orderDTO){
        $data = [
            'product_id' => $orderDTO->product_id,
            'quantity' => $orderDTO->quantity,
           ];
        return $this->orderReposityInterface->findById($id,$data);
    }
    public function delete($id){
      return $this->orderReposityInterface->destroy($id);
    }

}


