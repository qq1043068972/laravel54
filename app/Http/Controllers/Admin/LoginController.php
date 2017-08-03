<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('admin.login.login');
    }

    public function login() {

        $user = request(['email','password']);

        if(Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }else{
            return redirect('/admin/login')->withErrors('用户名或密码不正确!');
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
