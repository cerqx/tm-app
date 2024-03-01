<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'description' => ['string']
        ];
    }
}
