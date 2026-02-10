<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
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
            'status' => 'required|integer',
            'rejection_reason' => 'required_if:'.$this->status.',4|min:10|max:1000',
        ];
    }

    public function messages()
    {
        return[
            'rejection_reason.required' => 'The rejection reason is required.',
            'rejection_reason.max' => 'The rejection reason must not exceed 1000 characters.',
            'rejection_reason.min' => 'The rejection reason must be at least 10 characters.',
        ];
    }
}
