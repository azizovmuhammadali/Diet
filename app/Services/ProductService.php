<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use App\Interfaces\Services\ProductServiceInterface;
use App\Interfaces\Reposities\ProductReposityInterface;
use App\Models\Product;

class ProductService extends BaseService implements ProductServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ProductReposityInterface $productReposityInterface)
    {
        //
    }
    public function index(){
   return $this->productReposityInterface->Products();
    }
    public function store($productDTO){
        $translations = $this->prepareTranslations(['translations' =>$productDTO->translations], ['name','description']);
        $locale = App::getLocale(); 
          $name = $translations[$locale]['name']; 
          $slug = $this->generateUniqueSlug($name, Product::class);
          $data = [
         'translations' => $translations,
         'image' => $productDTO->image,
         'slug' => $slug,
         'calory' => $productDTO->calory,
          ];
          return $this->productReposityInterface->create($data);
    }
    public function show($id){
    return $this->productReposityInterface->getById($id);
    }
    public function update($id, $productDTO){
        $translations = $this->prepareTranslations(['translations' =>$productDTO->translations], ['name','description']);
        $locale = App::getLocale(); 
          $name = $translations[$locale]['name']; 
          $slug = $this->generateUniqueSlug($name, Product::class);
          $data = [
         'translations' => $translations,
         'image' => $productDTO->image,
         'slug' => $slug,
         'calory' => $productDTO->calory,
          ];
          return $this->productReposityInterface->findById($id,$data);
    }
    public function delete($id){
        return $this->productReposityInterface->destroy($id);
    }
    
}



