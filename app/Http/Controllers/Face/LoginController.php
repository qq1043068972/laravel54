<?php

namespace App\Http\Controllers\Face;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('face.login.index');
    }

    public function login() {
        $this->validate(request(),[
            'email'      =>'required | email',
            'password'   =>'required | min:3 | max:10',
            'is_remember'=>'integer'
        ]);

        $user = request(['email','password']);
        $is_remember = boolval(request()->input('is_remember'));

        if(Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }else{
            return back()->withErrors('邮箱或密码错误!');
        }

    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
