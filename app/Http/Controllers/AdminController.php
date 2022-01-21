<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccountType;
use GuzzleHttp\Psr7\Header;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    //
    public function index()
    {
        $i = 1;
        $lstUser = User::all();
        $type = DB::select('select * from account_types');
        return view('admin.index', [
            'lstUser' => $lstUser,
            'type' => $type,
            'stt' => $i
        ]);
    }

    public function addUser_get()
    {
        $type = DB::select('select * from account_types');
        return view('admin.add_user', [
            'type' => $type
        ]);
    }
    public function addUser_post(request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'email' => 'required||email||unique:users,email',
            'password' => 'required',
        ], [
            'fullname.required' => "Vui lòng nhập họ tên!",
            'phone.required' => "vui lòng nhập số điện thoại!",
            'birthday.required' => "vui lòng chọn ngày sinh!",
            'address.required' => "vui lòng nhập địa chỉ!",
            'email.required' => "vui lòng nhập email!",
            'email.email' => "email phải đúng định dạng!",
            'email.unique' => "email đã tồn tại!",
            'password.required' => "vui lòng nhập password",
        ]);
        $true = "có hiệu lực";
        $false = "tạm khoá";
        if ($request->status == "on") {
            $request->merge(['status' => $true]);
        } else {
            $request->merge(['status' => $false]);
        }
        $password = bcrypt($request->password);
        $request->merge(['password' => $password]);
        $success = User::create($request->all());
        return redirect()->route('home_admin');
    }


    public function updateUser_get(request $id)
    {
        $user = User::find($id);
        $type = DB::select('select * from account_types');
        return view('admin.update_user', [
            'user' => $user,
            'type' => $type
        ]);
    }
    public function updateUser_post(request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            // 'email' => 'required||email||unique:users,email',
            'password' => 'required',
        ], [
            'fullname.required' => "Vui lòng nhập họ tên!",
            'phone.required' => "vui lòng nhập số điện thoại!",
            'birthday.required' => "vui lòng chọn ngày sinh!",
            'address.required' => "vui lòng nhập địa chỉ!",
            // 'email.required' => "vui lòng nhập email!",
            // 'email.email' => "email phải đúng định dạng!",
            // 'email.unique' => "email đã tồn tại!",
            'password.required' => "vui lòng nhập password",
        ]);
        $true = "có hiệu lực";
        $false = "tạm khoá";
        $user = User::find($request->user);
        if ($request->status == "on") {
            $request->merge(['status' => $true]);
        } else {
            $request->merge(['status' => $false]);
        }
        $password = bcrypt($request->password);
        $request->merge(['password' => $password]);
        // $user::update($request->all());
        $user->fill([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'email' => $request->email,
            'password' => $request->password,
            'accType_Id' => $request->accType_Id,
            'status' => $request->status
        ]);
        $user->save();
        return redirect()->route('home_admin');
    }

    public function deleteUser(request $request)
    {
        DB::table('users')->where('id', '=', $request->id)->delete();
        return redirect()->route('home_admin');
    }
}
