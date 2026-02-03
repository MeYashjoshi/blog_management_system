<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
                'firstname' => 'required|string|max:20',
                'lastname' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'bio' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Firstname field is required.',
            'firstname.string' => 'Firstname field must be a string.',
            'firstname.max' => 'Firstname field must not exceed 20 characters.',

            'lastname.required' => 'Lastname field is required.',
            'lastname.string' => 'Lastname field must be a string.',
            'lastname.max' => 'Lastname field must not exceed 20 characters.',

            'email.required' => 'Email field is required.',
            'email.email' => 'Please enter a valid email address.',


        ];
    }
}
