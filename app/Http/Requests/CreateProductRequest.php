<?php

namespace App\Http\Requests;

use App\Enums\StatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Exception;

class CreateProductRequest extends FormRequest
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
            'category_id'=>'required|exists:categories,id',
            'name'=>'required|string',
            'description'=>'required|string',
            'price'=>'required|between:0,99.99',
            'status'=>[Rule::enum(StatusEnum::class)]
        ];
    }

    public function messages()
    {
        return [
            'category_id.exists'=> 'O :attribute não existe.',
            'name.string' => 'O :attribute precisa ser uma string',
            'description.string' => 'O :attribute precisa ser uma string',
            'category_id.required' => 'O :attribute é obrigatório',
            'name.required' => 'O :attribute é obrigatório',
            'description.required' => 'O :attribute é obrigatório',
            'price.required' => 'O :attribute é obrigatório',
        ];
    }
}
