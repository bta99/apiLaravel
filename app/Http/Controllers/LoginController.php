<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }

    public function loginPost(request $request)
    {
        $true = true;
        $false = false;
        $request->validate([
            'email' => 'required||email',
            'password' => 'required'
        ], [
            'email.required' => "vui lòng nhập email!",
            'email.email' => "email phải đúng định dạng!",
            'password.required' => "vui lòng nhập password",
        ]);
        $user = DB::select('select accType_Id from users where email = ?', [$request->email]);
        $user_status = DB::select('select status from users where email = ?', [$request->email]);
        if ($user_status[0]->status == "có hiệu lực") {
            if ($user[0]->accType_Id == 1) { //kiểm tra quyền
                if ($request->remember == "on") {
                    $request->merge(['remember' => $true]);
                } else {
                    $request->merge(['remember' => $false]);
                }
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    $request->session()->regenerate();
                    return redirect()->intended('admin');
                } else {
                    return back()->withErrors([
                        'faild' => "sai tên tài khoản hoặc mật khẩu!"
                    ]);
                }
            } else {
                echo "Trang Dành Cho User";
            }
        } else {
            return back()->withErrors([
                'faild' => "tài khoản đã bị khoá!"
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
