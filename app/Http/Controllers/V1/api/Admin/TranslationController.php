<?php

namespace App\Http\Controllers\V1\api\Admin;

use App\DTO\TranslationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationStoreRequest;
use App\Http\Requests\TranslationUpdateRequest;
use App\Http\Resources\TranslationResource;
use App\Interfaces\Services\TranslationServiceInterface;
use App\Traits\ResponseTrait;

class TranslationController extends Controller
{
    use ResponseTrait;
    public function __construct(protected TranslationServiceInterface $translationServiceInterface){}
    public function index()
    {
        $translations = $this->translationServiceInterface->AllTranslations();
        return $this->success (TranslationResource::collection($translations),__('successes.translations.all'));
    }

    public function store(TranslationStoreRequest $request)
    {
        $translationDTO = new TranslationDTO($request->locale,$request->key,$request->value,$request->is_active);
        $translation = $this->translationServiceInterface->create($translationDTO);
        return $this->success(new TranslationResource($translation),__('successes.translations.created'));
    }

    public function show(string $id)
    {
        $translation = $this->translationServiceInterface->show($id);
        return $this->success(new TranslationResource($translation),__('successes.translations.show'));
    }

    public function update(TranslationUpdateRequest $request, string $id)
    {
        $translationDTO = new TranslationDTO($request->locale, $request->key,$request->value,$request->is_active);
        $translation = $this->translationServiceInterface->update($id,$translationDTO);
        return $this->success(new TranslationResource($translation),__('successes.translations.updated'));
    }

    public function destroy(string $id)
    {
        $translation = $this->translationServiceInterface->delete($id);
        return $this->success([],__('successes.translations.deleted'),204);
    }
}