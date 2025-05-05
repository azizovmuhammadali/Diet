<?php

namespace App\Interfaces\Services;

interface LanguageServiceInterface
{
    public function AllLanguages();
    public function create($langDTO);
    public function show($id);
    public function update($id,$langDTO);
    public function delete($id);
}