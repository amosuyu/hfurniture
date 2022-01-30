<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ValidatePolicies extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:100',
            'content'=> 'required',
            'slug' => 'max:100'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên chính sách không được để trống!',
            'name.max' => 'Tên chính sách không được vượt qúa 100 ký tự!',
            'content.required' => 'Nội dung chính sách không được để trống!',
            'slug.max' => 'Slug không được vượt quá 100 ký tự!'
        ];
    }
}
