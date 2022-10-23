<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\User\UserService;

class AccountController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

    public function register()
    {
        return view('front.account.register');
    }

    public function postRegister(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return back()->with('notification', 'Lỗi: mật khẩu không khớp');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 2, //khách hàng thường
        ];

        $this->userService->create($data);

        return redirect('account/login')->with('notification', 'Đăng ký thành công, vui lòng đăng nhập');
    }
}
