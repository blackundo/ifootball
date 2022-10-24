<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }
    public function postLogin(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' =>$request->password,
            'level' => Constant::user_level_admin //Tk cấp độ admin
        ];
        $remember = $request->remember;
        if(Auth::attempt($credentials,$remember)){
            return redirect()->intended('admin/user');
        }else{
            return back()->with('notification','Không đủ thẩm quyền,hoặc sai tài khoản');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
