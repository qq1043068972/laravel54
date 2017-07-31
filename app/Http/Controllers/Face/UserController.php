<?php

namespace App\Http\Controllers\Face;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function setting() {
        $user = Auth::user();
        return view('face.user.setting',compact('user'));
    }

    public function settingStore() {
        $this->validate(request(),[
            'id'  => 'required',
            'name'=>'required',
            'email'=>'email'
        ]);

        $user = User::find(request('id'));
        $user->name = request('name');
        $user->email = request('email');
        if($user->save()){
            return redirect('/posts');
        }else{
            return back();
        }
    }
}
