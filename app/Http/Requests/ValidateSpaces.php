<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ValidateSpaces extends FormRequest
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
            'name_vi'=> 'required|max:100',
            'name_en'=> 'max:100',
            'description_vi' => 'max:255',
            'description_en' => 'max:255'
        ];
    }
    public function messages()
    {
        return [
            'name_vi.required' => 'Tên không gian không được để trống!',
            'name_vi.max' => 'Tên không gian không được vượt qúa 100 ký tự!',
            'name_en.max' => 'Tên không gian không được vượt qúa 100 ký tự!',
            'description_vi.max' => 'Mô tả không được vượt qúa 255 ký tự!',
            'description_en.max' => 'Mô tả không được vượt qúa 255 ký tự!',
            'display.required' => 'Ẩn hiện không được để trống'
        ];
    }
}
