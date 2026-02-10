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
            'firstname' => [
                'required',
                'string',
                'min:2',
                'max:20',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'lastname' => [
                'required',
                'string',
                'min:2',
                'max:20',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'emai',
                'max:255'
            ],
            'profile' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'bio' => [
                'required',
                'string',
                'max:150',
            ],
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Firstname field is required.',
            'firstname.string' => 'Firstname field must be a string.',
            'firstname.min' => 'Firstname must be at least 2 characters.',
            'firstname.max' => 'Firstname must not exceed 20 characters.',
            'firstname.regex' => 'Firstname can contain only letters and spaces.',
            'lastname.required' => 'Lastname field is required.',
            'lastname.string' => 'Lastname field must be a string.',
            'lastname.min' => 'Lastname must be at least 2 characters.',
            'lastname.max' => 'Lastname must not exceed 20 characters.',
            'lastname.regex' => 'Lastname can contain only letters and spaces.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email must not exceed 255 characters.',
            'bio.required' => 'Bio field is required.',
            'bio.string' => 'Bio must be a valid text.',
            'bio.max' => 'Bio must not exceed 150 characters.',
            'profile.image' => 'Profile must be an image file.',
            'profile.mimes' => 'Profile image must be a JPG or PNG file.',
            'profile.max' => 'Profile image size must not exceed 2 MB.',
        ];

    }
}
