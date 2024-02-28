<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'=>'exists:categories,id',
            'name'=>'string',
            'description'=>'string',
            'price'=>'between:0,99.99',
            'status'=>[Rule::enum(StatusEnum::class)]
        ];
    }

    public function messages()
    {
        return [
            'category_id.exists'=> 'O :attribute não existe.',
            'name.string' => 'O :attribute precisa ser uma string',
            'description.string' => 'O :attribute precisa ser uma string',
        ];
    }
}
