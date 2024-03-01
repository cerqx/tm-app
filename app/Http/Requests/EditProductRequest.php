<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['exists:categories,id'],
            'name' => ['string'],
            'description' => ['string'],
            'price' => ['numeric:2'],
            'status' => [Rule::enum(StatusEnum::class)]
        ];
    }
}
