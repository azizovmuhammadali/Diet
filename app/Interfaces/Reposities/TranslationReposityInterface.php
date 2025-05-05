<?php

namespace App\Interfaces\Reposities;

interface TranslationReposityInterface
{
    public function index();
    public function create($translation);
    public function getById($id);
    public function findById($id,$translation);
    public function deleteTranslation($id);
}