<?php

namespace App\Interfaces\Reposities;

interface OrderReposityInterface
{
    public function Orders();
    public function create($data);
    public function getById($id);
    public function findById($id,$data);
    public function destroy($id);
    public function filter($filter);
}
