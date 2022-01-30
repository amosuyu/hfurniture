<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPasswordRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function sendMail(Request $request)
    {
        if ($request->session()->get('website_language') == 'en') {
            $message = [];
        } else {
            $message = [
                'email.required' => 'Vui lòng nhập địa chỉ email',
                'email.email' => 'Email phải có định dạng là @gmail.com',
            ];
        }

        $request->validate(
            [
                'email' => 'required|email',
            ], $message
        );
        $user = User::where('email', $request->email)->first();

        if ($user != null) {
            $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => Str::random(60),
            ]);
            if ($passwordReset) {
                $user->notify(new ResetPasswordRequest($passwordReset->token));
            }
            $message_success = $request->session()->get('website_language') == 'en' ? 'Please check your email, we have sent you a password reset link' : 'Vui lòng kiểm tra Email, chúng tôi đã gửi tới Email của bạn đường dẫn đặt lại mật khẩu';
            return redirect()->back()->with('message', $message_success);
        } else {
            $message_error = $request->session()->get('website_language') == 'en' ? 'Email does not exist, please try again' : 'Email không tồn tại, vui lòng thử lại';
            return redirect()->back()->with('message_error', $message_error);
        }

    }

    public function reset(Request $request, $token)
    {
        $request->validate(
            [
                'password' => 'required|min:8|max:20',
                'confirm_password' => 'required|same:password',
            ],
            [
                'password.required' => 'Nhập mật khẩu mới',
                'password.min' => 'Mật khẩu mới phải nhiều hơn 8 ký tự',
                'password.max' => 'Mật khẩu mới phải ít hơn 20 ký tự',
                'confirm_password.required' => 'Nhập xác nhận mật khẩu mới',
                'confirm_password.same' => 'Mật khẩu mới không trùng khớp',
            ]);
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return redirect()->back()->with('message_error', 'Token không hợp lệ');
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update(['password' => bcrypt($request->get('password'))]);
        $passwordReset->delete();

        return redirect()->back()->with('message_success', 'Cập nhật mật khẩu mới thành công!');
    }

    public function resetPassword($token)
    {
        return view('client.auth.reset_password', compact('token'));
    }
}
