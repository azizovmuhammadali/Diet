<?php

namespace App\Services;

use App\Interfaces\Reposities\LanguageReposityInterface;
use App\Interfaces\Services\LanguageServiceInterface;

class LanguageService implements LanguageServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected LanguageReposityInterface $languageReposity){}
    public function AllLanguages(){
    return $this->languageReposity->index();
    }
    public function create($langDTO){
      $lang = [
     'name' => $langDTO->name,
     'prefix' => $langDTO->prefix,
     'is_active' => $langDTO->is_active,
      ];
    return  $this->languageReposity->createLang($lang);
    }
    public function show($id){
    return $this->languageReposity->getById($id);
    }
    public function update($id, $langDTO){
        $lang = [
            'name' => $langDTO->name,
            'prefix' => $langDTO->prefix,
            'is_active' => $langDTO->is_active,
             ];
           return  $this->languageReposity->findById($id,$lang);
    }
    public function delete($id){
     return $this->languageReposity->deleteLang($id);
    } 
}