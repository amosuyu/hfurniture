<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function sendMail(Request $request)
    {
        if($request->session()->get('website_language') == 'en'){
            $message = [];
        }else {
            $message = [
                'name.required' => 'Họ tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email phải có định dạng là @gmail.com',
                'phone.digits' => 'Điện thoại phải là số và có 10 số',
                'message.required' => 'Nội dung liên hệ không được để trống'
            ];
        }
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'digits:10',
                'message' => 'required',
            ],
            $message
        );
        // get data
        $data = $request->all();
        // send mail
        Mail::to('danhnhps11245@fpt.edu.vn')->send(new SendMail($data));
        $mess_success = $request->session()->get('website_language') == 'en' ? 'Contact has been sent successfully, we will respond as soon as possible' : 'Gửi liên hệ thành công, chúng tôi sẽ phản hồi sớm nhất có thể';
        return redirect('lien-he')->with('message', $mess_success);
    }
}
