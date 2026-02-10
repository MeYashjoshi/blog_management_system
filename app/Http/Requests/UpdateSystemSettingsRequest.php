<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSystemSettingsRequest extends FormRequest
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
            'sitename' => [
                'required',
                'string',
                'min:3',
                'max:8',
            ],

            'supportemail' => [
                'required',
                'email',
                'max:255',
            ],

            'contactnumber' => [
                'required',
                'digits:10',
            ],

            'address' => [
                'required',
                'string',
            ],

            'sitelogo' => [
                'nullable',
                'image',
                'max:2048',
            ],

            'favicon' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'sitename.required' => 'Sitename is required.',
            'sitename.min' => 'Sitename must be at least 3 characters.',
            'sitename.max' => 'Sitename must not exceed 8 characters.',
            'supportemail.required' => 'Support email is required.',
            'supportemail.email' => 'Please enter a valid email address.',
            'contactnumber.required' => 'Contact number is required.',
            'contactnumber.digits' => 'Contact number must be exactly 10 digits.',

            'address.required' => 'Address is required.',
            'sitelogo.image' => 'Site logo must be an image.',
            'sitelogo.max' => 'Site logo must not exceed 2MB.',

            'favicon.image' => 'Favicon must be an image.',
            'favicon.max' => 'Favicon must not exceed 2MB.',
        ];
    }
}
