<?php

namespace App\Reposities;

use App\Models\Translation;
use App\Interfaces\Reposities\TranslationReposityInterface;
use Illuminate\Support\Facades\Auth;

class TranslationReposity implements TranslationReposityInterface
{
    public function index(){
        $locale = request()->header('Accept-Language');
        $translations = Translation::where('locale',$locale)->get();
        return $translations;
    }
    public function create($translation){
   $translte = new Translation();
   $translte->locale = $translation['locale'];
   $translte->key = $translation['key'];
   $translte->value = $translation['value'];
   $translte->is_active = $translation['is_active'];
   $translte->save();
   return $translte;
    }
    public function getById($id){
  $trans = Translation::findOrFail($id);
  return $trans;
    }
    public function findById($id, $translation){
        $translte = Translation::findOrFail($id);
        $translte->locale = $translation['locale'];
        $translte->key = $translation['key'];
        $translte->value = $translation['value'];
        $translte->is_active = $translation['is_active'];
        $translte->save();
        return $translte;
    }
    public function deleteTranslation($id){
      $trans = Translation::findOrFail($id);
      $trans->delete();
    }
}