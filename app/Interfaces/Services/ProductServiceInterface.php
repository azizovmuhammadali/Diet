<?php

namespace App\Interfaces\Services;

interface ProductServiceInterface
{
   public function index();
   public function store($productDTO);
   public function show($id);
   public function update($id,$productDTO);
   public function delete($id);
}
