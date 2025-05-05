<?php

namespace App\Http\Controllers\V1\api\Admin;

use App\DTO\LanguageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Http\Resources\LanguageResource;
use App\Interfaces\Services\LanguageServiceInterface;
use App\Traits\ResponseTrait;

class LanguageController extends Controller
{
    use ResponseTrait;
    public function __construct(protected LanguageServiceInterface $languageServiceInterface){}
    public function index()
    {
        $languages = $this->languageServiceInterface->AllLanguages();
        return $this->responsePagination($languages,LanguageResource::collection($languages),__('successes.languages.all'));
    }

    public function store(LanguageStoreRequest $request)
    {
        
        $langDTO = new LanguageDTO($request->name,$request->prefix,$request->is_active);
        
        $lang = $this->languageServiceInterface->create($langDTO);
        return $this->success(new LanguageResource($lang),__('successes.languages.created'));
    }

    public function show(string $id)
    {
        $lang = $this->languageServiceInterface->show($id);
        return $this->success(new LanguageResource($lang),__('successes.languages.show'));
    }

    public function update(LanguageUpdateRequest $request, string $id)
    {
        $langDTO = new LanguageDTO($request->name,$request->prefix,$request->is_active);
        $language = $this->languageServiceInterface->update($id, $langDTO);
        return $this->success(new LanguageResource($language),__('successes.languages.updated'));
    }   

    public function destroy(string $id)
    {
       $lang = $this->languageServiceInterface->delete($id);
       return $this->success([],__('successes.languages.deleted'),204);
    }
}