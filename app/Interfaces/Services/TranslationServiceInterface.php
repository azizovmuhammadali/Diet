<?php

namespace App\Interfaces\Services;

interface TranslationServiceInterface
{
    public function AllTranslations();
    public function create($translationDTO);
    public function show($id);
    public function update($id,$translationDTO);
    public function delete($id);
}