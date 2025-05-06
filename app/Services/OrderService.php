<?php

namespace App\Services;

use App\Models\Product;
use App\Interfaces\Services\OrderServiceInterface;
use App\Interfaces\Reposities\OrderReposityInterface;

class OrderService extends BaseService implements OrderServiceInterface
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
    public function store($data)
    {
        // Order yaratish
        $maxCalory = $data->max_calory; // Requestdan kelgan max_calory
        $productIds = $data->product_id; // Mahsulot IDlari
        $quantities = $data->quantity; // Mahsulotlar soni

        // Har bir mahsulotning kaloriyasini hisoblash
        $totalCalory = 0;
        foreach ($productIds as $key => $productId) {
            $product = Product::findOrFail($productId);
            $calory = (int) filter_var($product->calory, FILTER_SANITIZE_NUMBER_INT); // Mahsulot kaloriyasini olish
            $totalCalory += $calory * $quantities[$key]; // Mahsulot kaloriyasini quantityga ko'paytirish
        }

        // Agar umumiy calory max_calorydan oshsa, xatolik qaytarish
        if ($totalCalory > $maxCalory) {
            throw new \Exception(__('errors.order.limit'));
        }

        // Orderni yaratish
        return $this->orderReposityInterface->create($data);
    }
    
    
    public function show($id){
     return $this->orderReposityInterface->getById($id);
    }
    public function update($id, $orderDTO)
    {
        $totalCalory = 0;
        foreach ($orderDTO->product_id as $key => $productId) {
            $product = Product::findOrFail($productId);
            $calory = (int) filter_var($product->calory, FILTER_SANITIZE_NUMBER_INT); // Mahsulotning kaloriyasini olish
            $totalCalory += $calory * $orderDTO->quantity[$key]; // Mahsulot kaloriyasini quantityga ko'paytirish
        }
        if ($totalCalory > $orderDTO->max_calory) {
            throw new \Exception(__('errors.order.limit'));
        }
        return $this->orderReposityInterface->findById($id, $orderDTO);
    }
    
    public function delete($id){
      return $this->orderReposityInterface->destroy($id);
    }
    public function search($filter){
        return $this->orderReposityInterface->filter($filter);
    }
}


