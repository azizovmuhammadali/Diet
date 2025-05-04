<?php

namespace App\Interfaces\Services;

interface OrderServiceInterface
{
    public function index();
    public function store($orderDTO);
    public function show($id);
    public function update($id,$orderDTO);
    public function delete($id);
}
