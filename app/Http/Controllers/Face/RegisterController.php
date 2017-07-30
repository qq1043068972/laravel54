<?php

namespace App\Http\Controllers\Face;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function create() {
        return view('face.register.create');
    }

    public function store() {
        $this->validate(request(),[
            'name'    =>'required | min:3 |unique:users,name',
            'email'   =>'required | email |unique:users,email',
            'password'=>'required | min:3 | max:10 | confirmed',
        ]);
        
        $name     = request('name');
        $email    = request('email');
        $password = bcrypt(request('password'));

        $user = User::create(compact('name','email','password'));

        if(!empty($user)){
            return redirect('login');
        }else{
            return back()->with('error','注册失败!');
        }
    }
}
