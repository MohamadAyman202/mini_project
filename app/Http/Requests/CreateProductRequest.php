<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'title'                 => 'required|string',
            'photo'                 => 'required|image|mimes:png,jpg,jpeg,svg',
            'description'           => 'required|string',
            'meta_description'      => 'required|string|max:100',
            'category_id'           => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id'       =>  'category',
        ];
    }
}
