<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login()
    {
        return view('front.account.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 2, //tài khoản câps đồ khách hàng bình thường
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            return redirect(''); //trang chủ
        } else {
            return back()->with('notification', 'Lỗi: Email hoặc mật khẩu sai');
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}
