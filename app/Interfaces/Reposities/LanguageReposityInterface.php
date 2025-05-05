<?php

namespace App\Interfaces\Reposities;

interface LanguageReposityInterface
{
    public function index();
    public function createLang($lang);
    public function getById($id);
    public function findById($id,$lang);
    public function deleteLang($id);
}