<?php

namespace App\Interfaces\Reposities;

interface ProductReposityInterface
{
    public function Products();
    public function create($data);
    public function getById($id);
    public function findById($id,$data);
    public function destroy($id);
}
