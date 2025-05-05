<?php

namespace App\Reposities;

use App\Interfaces\Reposities\LanguageReposityInterface;
use App\Models\Language;

class LanguageReposity implements LanguageReposityInterface
{
    /**
     * Create a new class instance.
     */
   public function index(){
    $languages = Language::where('is_active', true)->paginate(5);
    return $languages;
   }
   public function createLang($lang){
   $language = new Language();
   $language->name = $lang['name'];
   $language->prefix = strtolower($lang['prefix']);
   $language->is_active = $lang['is_active'];
   $language->save();
   return $language;
}
   public function getById($id){
    $language = Language::findOrFail($id);
    return $language;
   }
   public function findById($id, $lang){
   $language = Language::findOrFail($id);
   $language->name = $lang['name'];
   $language->prefix = strtolower($lang['prefix']);
   $language->is_active = $lang['is_active'];
   $language->save();
   return $language;
   }
   public function deleteLang($id){
   $lang = Language::findOrFail($id);
   $lang->delete();
   }
}