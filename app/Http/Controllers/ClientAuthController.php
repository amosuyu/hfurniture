<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ClientAuthController extends Controller
{

    // return trang đăng nhập
    public function login()
    {
        if(str_contains(redirect()->getUrlGenerator()->previous(), "dat-lai-mat-khau")){
            session(['pageRedirect' => '/']);
        }else{
            session(['pageRedirect' => url()->previous()]);
        }
       
        if (Auth::user()) {
            return redirect('/');
        } else {
            return view('client.auth.login');
        }

    }

    // Xử lý đăng nhập
    public function handleLogin(Request $request)
    {
        if ($request->session()->get('website_language') == 'en') {
            $messages = [];
        } else {
            $messages = [
                'email_log.required' => 'Vui lòng nhập địa chỉ email',
                'email_log.email' => 'Email phải có định dạng là @gmail.com',
                'password_log.required' => 'Vui lòng nhập mật khẩu',
            ];
        }
        $request->validate(
            [
                'email_log' => 'required|email',
                'password_log' => 'required',
            ], $messages
        );
        $request->merge([
            'email' => $request->get('email_log'),
            'password' => $request->get('password_log'),
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect(session('pageRedirect'))->with('alertAuth', $request->session()->get('website_language') == 'en' ? 'Logged in successfully' : 'Đăng nhập thành công');
        }
        $login_message = $request->session()->get('website_language') == 'en' ? 'Incorrect email or password' : 'Email hoặc mật khẩu không chính xác';
        return redirect("dang-nhap")->with('login_message', $login_message );
    }

    // Xử lý đăng ký
    public function handleRegister(ValidateAuth $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->get('password'));
        $check = User::create($data);
        if ($check) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect("/")->with('alertAuth', $request->session()->get('website_language') == 'en' ? 'Register in successfully' : 'Đăng ký tài khoản và đăng nhập thành công');
            }
        }
    }

    // Xử lý logout
    public function logout()
    {
        Auth::logout();
        return Redirect('/dang-nhap');
    }

    // return trang thông tin khách hàng
    public function information()
    {
        if (Auth::user()) {
            return view('client.auth.information');
        } else {
            return redirect('dang-nhap');
        }

    }

    // cập nhật thông tin khách hàng
    public function updateInformation(ValidateAuth $request )
    {
        $data = $request->all();
        $user = User::where('id', Auth::user()->id)->first();
        $user->update($data);
        if($request->session()->get('website_language') == 'en'){
           $message = 'Account update successful'; 
        }else $message = 'Cập nhật tài khoản thành công';
        return redirect('thong-tin-tai-khoan')->with('message', $message);
    }

    // return trang quên mật khẩu
    public function forgotPassword()
    {
        return view('client.auth.forgot_password');
    }

    // xử lý thay đổi mật khẩu
    public function changePassword(Request $request)
    {
        if($request->session()->get('website_language') == 'en'){
            $messages = [];
        }else {
            $messages = [
                'old_password.required' => 'Nhập mật khẩu cũ của bạn',
                'new_password.required' => 'Nhập mật khẩu mới của bạn',
                'new_password.min' => 'Mật khẩu phải nhiều hơn 8 ký tự',
                'new_password.max' => 'Mật khẩu phải ít hơn 20 ký tự',
                'confirm_new_password.required' => 'Xác nhận lại mật khẩu mới',
                'confirm_new_password.same' => 'Mật khẩu mới không trùng khớp',
            ];
        }
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:20',
            'confirm_new_password' => 'required|same:new_password',
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('thong-tin-tai-khoan?page=thay-doi-mat-khau')->withInput()->withErrors($validator);
        } else {
            $user = User::find(Auth::user()->id);
            $oldPassword = $request->get('old_password');
            $messages_success = $request->session()->get('website_language') == 'en' ? 'Change password successfully' : 'Thay đổi mật khẩu thành công';
            $messages_error = $request->session()->get('website_language') == 'en' ? 'Old password is incorrect' : 'Mật khẩu cũ ko chính xác';
            if (Hash::check($oldPassword, $user->password)) {
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                return redirect('thong-tin-tai-khoan')->with('message', $messages_success );
            } else {
                return redirect('thong-tin-tai-khoan?page=thay-doi-mat-khau')->with('message_error', $messages_error );
            }

        }

    }
}
