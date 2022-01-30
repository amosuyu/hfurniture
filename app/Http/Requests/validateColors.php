<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateColors extends FormRequest
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
            'name' => ['required','max:25'],
            'code' => ['required'], 
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên màu không được để trống!',
            'name.max' => 'Tên màu không được vượt qúa 25 ký tự!',
            'code.required' => 'Mã màu không được để trống!',
        ];
    }
}
