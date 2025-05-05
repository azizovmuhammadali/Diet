<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'locale' => 'nullable',
            'key'=> 'nullable',
            'value'=> 'nullable',
            'is_active'=> 'nullable|boolean',
        ];
    }
}