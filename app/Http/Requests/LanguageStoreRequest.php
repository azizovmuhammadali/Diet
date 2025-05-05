<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name"=> "required|string",
            "prefix"=> "required|unique:languages,prefix",
            "is_active"=> "required|boolean",
        ];
    }
}