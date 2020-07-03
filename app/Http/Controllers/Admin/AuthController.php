<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class AuthController extends BaseController
{

    public function login(){

        if(Auth::user()){
            return redirect('/admin');
        }

        return view('admin.auth.login');
    }

    public function login_post(AdminLoginRequest $request){
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('/admin');
        }else{
            return redirect()->back()->with('error', 'wrong email or password');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}

