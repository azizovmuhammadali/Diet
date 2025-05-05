<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'locale' => 'required|exists:languages,prefix',
            'key'=> 'required|unique:translations,key',
            'value'=> 'required',
            'is_active'=> 'required|boolean',
        ];
    }
}