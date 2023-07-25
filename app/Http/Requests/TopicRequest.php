<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
                'name' =>'required|min:3|max:255|string',
                'classroom_id' => 'int|exists:classrooms,id' ,
            ];
    }

    public function messages()
    {
        return [
            'required'  =>':attributes important',
            'name.required' => 'the name is requied',
        ];
    }
}
