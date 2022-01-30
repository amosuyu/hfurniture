<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ValidateProducts extends FormRequest
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
       return[
        'name_vi'=> 'required|max:100',
        'name_en'=> 'max:100',
        'description_vi' => 'max:255',
        'description_en' => 'max:255',
        'content_vi' => 'required',
        'price'=> 'required|numeric',
        'category_id' => 'required',
        'height'=> 'required',
        'width'=> 'required',
       ];
    }
    public function messages()
    {

       return[
        'name_vi.required' => 'Tên sản phẩm không được để trống!',
        'name_vi.max' => 'Tên không gian không được vượt qúa 100 ký tự!',
        'name_en.max' => 'Tên sản phẩm không được vượt qúa 100 ký tự!',
        'description_vi.max' => 'Mô tả không được vượt qúa 255 ký tự!',
        'description_en.max' => 'Mô tả không được vượt qúa 255 ký tự!',
        'content_vi.required' => 'Nội dung không được để trống!',
        'price.required' => 'Giá tiền không được để trống',
        'price.numeric' => 'Giá tiền phải là số',
        'category_id.required' => 'Loại sản phẩm không được để trống',
        'height.required' => 'Chiều cao',
        'width.required' => 'Chiều rộng',
       ];
    }
}
