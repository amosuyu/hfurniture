<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateBlogtypes extends FormRequest
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
            'title' => 'required|max:100',
            'description' => 'max:255',
            'slug' => 'max:100',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tên loại tin không được để trống!',
            'title.max' => 'Tên loại tin không được vượt qúa 100 ký tự!',
            'description.max' => 'Mô tả không được vượt qúa 255 ký tự!',
            'slug.max' => 'Slug không được vướt quá 100 ký tự',
        ];
    }
}
