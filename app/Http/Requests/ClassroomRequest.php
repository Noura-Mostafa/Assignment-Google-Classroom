<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
{
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
                'name' =>'required|min:3|max:255|string', function($attributes , $value , $fail){
                  if ($value == 'admin') {
                    return $fail('this :attribute value is forbbiden');
                  }
                },
                'section' =>'nullable|string|max:255',
                'subject' =>'nullable|string|max:255',
                'room' =>'nullable|string|max:255',
                'cover_image' => [
                    'nullable',
                    'image',
                    Rule::dimensions([
                        'min_width' => 444,
                        'min_height' => 110,
                    ]),
                ],
            ];
    }

    public function messages(): array
    {
        return [
            'required'  =>':attributes important',
            'name.required' => 'the name is requied',
            'cover_image.max' => 'image size is great than 1M',
        ];
    }
}
