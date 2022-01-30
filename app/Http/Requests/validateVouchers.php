<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ValidateVouchers extends FormRequest
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
            'description' => ['required','max:255'],
            'amount' => ['required_without:percent'],
            'percent' => ['required_without:amount'],
            'code' => ['required','max:45'],
            'end_date' => ['required'], 
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'Mô tả không được để trống',
            'amount.required_without' => 'Số tiền giảm không được để trống',
            'percent.required_without' => 'Phần trăm giảm không được để trống',
            'code.required' => 'Mã voucher không được để trống',
            'code.max' => 'Mã voucher không quá 45 ký tự',
            'end_date.required' => 'Chọn ngày kết thúc'
        ];
    }
}
