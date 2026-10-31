<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule; 
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePost extends FormRequest
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
            'title' => ['required','string','min:5', 
                Rule::unique('posts', 'title')->ignore($this->route('blog'))],
            'body'  => ['required','string','min:10',
                Rule::unique('posts', 'body')->ignore($this->route('blog'))],
            'published' => ['nullable', 'boolean'], // ✅ صح! كل شرط عنصر مستقل في Array    
        ];
    }
    public function messages(){
        return [    

            'title.required' => 'يا غالي لازم تكتب عنوان للبوست!',
            'title.min'      => 'العنوان قصير أوي، خليه 5 حروف على الأقل.',
            'body.required'  => 'محتوى البوست ما ينفعش يكون فاضي.',
            'body.min' => 'محتوى البوست قصير أوي، خليه 10 حروف على الأقل.'

        ];
    }
}
