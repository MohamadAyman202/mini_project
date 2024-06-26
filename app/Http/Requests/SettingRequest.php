<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title'     => 'required|string',
            'logo'      => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'favicon'   => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'facebook'  => 'required|url',
            'instagram' => 'required|url',
            'twitter'   => 'required|url'
        ];
    }


}
