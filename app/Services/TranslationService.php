<?php

namespace App\Services;

use App\Interfaces\Reposities\TranslationReposityInterface;
use App\Interfaces\Services\TranslationServiceInterface;

class TranslationService implements TranslationServiceInterface
{
    public function __construct(protected TranslationReposityInterface $translationReposity){}
    public function AllTranslations(){
   return $this->translationReposity->index();
    }
    public function create($translationDTO){
      $translation = [
      'locale' => $translationDTO->locale,
      'key' => strtolower($translationDTO->key),
      'value' => $translationDTO->value,
      'is_active' => $translationDTO->is_active,
      ];
      return $this->translationReposity->create($translation);
    }
    public function show($id){
     return $this->translationReposity->getById($id);
    }
    public function update($id, $translationDTO){
        $translation = [
            'locale' => $translationDTO->locale,
            'key' => strtolower($translationDTO->key),
            'value' => $translationDTO->value,
            'is_active' => $translationDTO->is_active,
            ];
            return $this->translationReposity->findById($id, $translation);
    }
    public function delete($id){
        return $this->translationReposity->deleteTranslation($id);
    }
}