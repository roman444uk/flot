<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'    => 'required|unique:ads|string|max:255',
            'photos'   => 'required|array|min:1|max:10',
            'photos.*' => 'required|mimes:jpg,png,jpeg|max:20000',
        ];
    }
}
