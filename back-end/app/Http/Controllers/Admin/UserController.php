<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utilities\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name','like','%'.$search.'%')->paginate(5);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->get('password') != $request->get('password_confirmation')){
            return back()->with('notification','Mật khẩu xác nhận không trùng khớp');
        }
        //Xử lí ảnh
        $data = $request->all();

        if($request->hasFile('image')){
            $data['avatar'] = Common::uploadFile($request->file('image'),'front/imgs/user');
        }
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return redirect('admin/user/'.$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data=$request->all();
        //Xử lí Mk
        if($request->get('password')!=null){
            if($request->get('password') != $request->get('password_confirmation')){
                return back()->with('notification','Mật khẩu xác nhận không trùng khớp');
            }
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        //Xử lí ảnh
        if($request->hasFile('image')){
            $file_name_old = $request->get('image_old');
            $data['avatar'] = Common::uploadFile($request->file('image'),'front/imgs/user');
            //Xóa file cũ
            if($file_name_old !='' && $file_name_old!='default-avatar.png'){
                unlink('front/imgs/user/'.$file_name_old);
            }
        }

        $user->update($data);
        return  redirect('admin/user/'.$user->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        //Xóa file
        //Xóa file cũ
        $file_name_old = $user->avatar;
        $user->delete();
        if($file_name_old !=''){
            unlink('front/imgs/user/'.$file_name_old);
        }
        return  redirect('admin/user');
    }
}
