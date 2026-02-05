<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBlogRequest extends FormRequest
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
        $blogId = $this->id??null;

        return [
            'id' => 'nullable|integer',
            'category_id' => 'required|integer',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'required|string|max:50|unique:blogs,title,' . $blogId . ',id,author_id,' . Auth::id(),
            'content' => 'required|max:3000',
            'tags' => 'nullable|string',
            'status' => 'required|integer',
         
        ];

    }

    public function messages()
    {
        return [
            'category_id.required' => 'category field is required.',

            'featured_image.image' => 'featured image must be an image file.',
            'featured_image.mimes' => 'featured image must be a jpg, jpeg or png.',
            'featured_image.max' => 'featured image must be 2048 kilobytes.',

            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'title.unique' => 'The same title exist',

            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
            'content.max' => 'The content field must not exceed 3000 characters.',

            'tags.required' => 'The tags field is required.',
            'tags.string' => 'The tags field must be a string.',

            'status.required' => 'The status field is required.',
        ];
    }
}
