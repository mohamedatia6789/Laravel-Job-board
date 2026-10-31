<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule; 
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateComment extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "author" => "required|string|min:2|max:255",
            "body" => "required|string|min:5|max:100",
            'post_id' => 'required|exists:posts,id'
        ];
    }
    public function messages(): array
    {
        return [
            "author.required" => "Author name is required.",
            "author.string" => "Author name must be a string.",
            "author.min" => "Author name must be at least :min characters.",
            "author.max" => "Author name must not exceed :max characters.",

            "body.required" => "Comment body is required.",
            "body.min" => "Comment body must be at least :min characters.",
            "body.max" => "Comment body must not exceed :max characters."
        ];
    }
}
 