<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
class ValidateAuth extends FormRequest
{

    // Redirect to the given url
    public $redirect;

    // Redirect to a given route
    public $redirectRoute;

    // Redirect to a given action
    public $redirectAction;

    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        return parse_url(url()->previous())['path'];
    }

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
            'name' => 'required|max:45',
            'email' => ['required', 'email', Auth::user() ? 'unique:users,email,' . Auth::user()->id : 'unique:users,email,' . $this->users . ',id'],
            'password' => Auth::user() ? '' : 'required|min:8|max:20',
            'confirm_password' => Auth::user() ? '' : 'required|same:password',
            'gender' => 'required',
            'phone' => ['required', 'digits:10', Auth::user() ? 'unique:users,phone,' . Auth::user()->id : 'unique:users,phone,' . $this->users . ',id'],
            'address' => 'required|max:255',
        ];
    }
    public function messages()
    {
        if (Session('website_language') != 'en') {
            return [
                'name.required' => 'Vui lòng nhập họ tên',
                'name.max' => 'Không được quá 45 ký tự',
                'email.required' => 'Vui lòng nhập địa chỉ email!',
                'email.email' => 'Email phải kết thúc với @gmail.com',
                'email_rs.max' => 'Email không được quá 100 ký tự',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu không được ít hơn 8 ký tự',
                'password.max' => 'Mật khẩu không được dài hơn 20 ký tự',
                'confirm_password.required' => 'Xác nhận lại mật khẩu',
                'confirm_password.same' => 'Mật khẩu không trùng khớp',
                'gender.required' => 'Vui lòng chọn giới tính',
                'phone.required' => 'Vui lòng nhập số điện thoại!',
                'phone.regex' => 'Số điện thoại không hợp lệ',
                'phone.digits' => 'Số điện thoại phải là số và đủ 10 số',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'address.max' => 'Địa chỉ không được quá 255 ký tự',
            ];
        } else {
            return [];
        }

    }
}
