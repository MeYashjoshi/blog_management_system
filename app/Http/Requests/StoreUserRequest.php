<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * Mirrors the client-side validation in public/assets/js/pages/custom.js
     */
    public function rules(): array
    {

        return [
            'firstname' => ['required', 'string', 'min:2', 'max:20', 'regex:/^[a-zA-Z ]+$/'],
            'lastname' => ['required', 'string', 'min:2', 'max:20', 'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:150',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).+$/',
            ],
            // JS uses `confirm_password` (equalTo #password), so validate here with same:password
            'confirm_password' => ['required', 'same:password'],
            'checkbox1' => ['accepted'],
        ];
    }

    /**
     * Custom messages that mirror the client-side messages.
     */
    public function messages(): array
    {
        return [
            'firstname.required' => 'Firstname is required.',
            'firstname.min' => 'Firstname must be at least 2 characters.',
            'firstname.max' => 'Firstname must not exceed 20 characters.',
            'firstname.regex' => 'Only letters and spaces are allowed.',

            'lastname.required' => 'Lastname is required.',
            'lastname.min' => 'Lastname must be at least 2 characters.',
            'lastname.max' => 'Lastname must not exceed 20 characters.',
            'lastname.regex' => 'Only letters and spaces are allowed.',

            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already in use.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password must not exceed 150 characters.',
            'password.regex' => 'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.',

            'confirm_password.required' => 'Confirm password is required.',
            'confirm_password.same' => 'Passwords do not match.',
            'checkbox1.accepted' => 'Please accept the terms and conditions.',
        ];
    }

    // protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    // {
    //     dd($validator->errors());
    // }
}
