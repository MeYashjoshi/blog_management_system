<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        'id' => ['nullable'],

        'title' => [
            'required',
            'string',
            'min:5',
            'max:50',
            'regex:/^[a-zA-Z\s]+$/',
        ],

        'description' => [
            'nullable',
            'string',
            'max:255',
        ],

        'status' => [
            'required',
            'integer',
        ],
    ];
}

public function messages(): array
{
    return [
        'title.required' => 'Category name is required.',
        'title.string'   => 'Category name must be a valid string.',
        'title.min'      => 'Category name must be at least 5 characters.',
        'title.max'      => 'Category name must not exceed 50 characters.',
        'title.regex'    => 'Category name can contain only letters and spaces.',

        'status.required' => 'Please select a status.',
        'status.integer'  => 'Invalid status selected.',

        'description.max' => 'Description must not exceed 255 characters.',
    ];
}

}
