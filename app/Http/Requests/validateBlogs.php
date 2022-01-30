<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateBlogs extends FormRequest
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
            'blog_type_id' => 'required',
            'description' => 'max:255',
            'content' => 'required',
            'slug' => 'max:100',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được để trống!',
            'title.max' => 'Tiêu đề không được vượt qúa 100 ký tự!',
            'blog_type_id.required' => 'Chọn loại tin!',
            'description.max' => 'Mô tả không được quá 255 ký tự',
            'content.required' => 'Nội dung không được để trống',
            'slug.max' => 'Slug không được quá 100 ký tự'
        ];
    }
}
