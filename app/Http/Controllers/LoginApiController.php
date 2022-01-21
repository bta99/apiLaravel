<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LoginApiController extends Controller
{
    public function fixImage($cl)
    {
        if (Storage::disk('public')->exists($cl->image)) {
            $cl->image = Storage::url($cl->image);
        } else {
            $cl->image = 'images/no-ig.png';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

    public function login(request $request)
    {
        // $check = $request -> validate([
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return response([
                'sucess' => 'true',
                'result' => $user
            ]);
        } else {
            return response([
                'sucess' => 'false'
            ]);
        }
    }

    public function register(request $request)
    {
        $pro = new User();
        $password = bcrypt($request->password);
        $request->merge(['password' => $password]);
        $pro->fill([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->password,
            'status' => 'có hiệu lực',
            'accType_Id' => 2,
            'image' => ''
        ]);
        $pro->save();
        return response([
            'sucess' => 'true'
        ]);
    }


    public function getAccount($id)
    {
        $user = User::find($id);
        return response([
            'account' => $user
        ]);
    }


    public function updateInfo(request $request)
    {
        $user = User::where('id', $request->id)->get();
        foreach ($user as $u) {
            $u->fullname = $request->fullname;
            $u->phone = $request->phone;
            $u->address = $request->address;
            $u->update();
        }
        return response([
            'success' => true,
            'user' => $user
        ]);
    }


    public function changePassword(request $request)
    {
        $user = DB::select('select password from users where id = ?', [$request->account_id]);
        $oldpass = bcrypt($request->oldpass);
        $newpass = bcrypt($request->newpass);
        if (Auth::attempt(['id' => $request->account_id, 'password' => $request->oldpass])) {
            DB::update('update users set password = ? where users.id = ?', [$newpass, $request->account_id]);
            return response([
                'success' => true,
            ]);
        } else {
            return response([
                'success' => false,
            ]);
        }
    }
}
