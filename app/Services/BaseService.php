<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Traits\ResponseTrait;
use App\Traits\TranslationTrait;

class BaseService
{
    use ResponseTrait;
    use TranslationTrait;
    protected function generateUniqueSlug(string $name, string $modelClass, string $column = 'slug'): string
    {
        $slug = Str::slug($name);
        $counter = 1;

        while ($modelClass::where($column, $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
