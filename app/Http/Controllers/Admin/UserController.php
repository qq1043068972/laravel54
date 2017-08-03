<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index() {
        $adminUsers = AdminUser::orderBy('created_at','desc')->orderBy('id','desc')->paginate(7);
        return view('admin.user.index',compact('adminUsers'));
    }

    public function create() {
        return view('admin.user.create');
    }

    public function store() {

        $this->validate(request(),[
            'name'     => 'required',
            'password' => 'required | min:3 | max:6 |  confirmed',
            'status'   => 'required',
            'email'    => 'required | email'

        ]);
        $password = bcrypt(request('password'));

        $adminUserArr = array_merge(request(['name','status','email']),compact('password'));
        $newAdminUser = AdminUser::create($adminUserArr);
        if(empty($newAdminUser)){
            return back()->withErrors('增加失败');
        }else{
            return redirect('/admin/users');
        }
    }

    public function edit(AdminUser $user) {
        return view('admin.user.edit',compact('user'));
    }

    public function update(AdminUser $user) {

        $this->validate(request(),[
            'name'     => 'required',
            'email'    => 'email',
            'password' => 'required | min:3 | max:6 | confirmed',
            'status'   => 'required'
        ]);
        if(!Hash::check(request('password'),$user->password)){
            return back()->withErrors('原密码不正确!');
        }

        $user->name  = trim(request('name'));
        $user->email = trim(request('email'));
        $user->status= trim(request('status'));
        $user->password = bcrypt(trim(request('password')));

        if($user->save()){
            return redirect('admin/users')->withErrors('修改成功!');
        }else{
            return back()->withErrors('修改失败!');
        }

    }

    public function isStatus(AdminUser $user) {
        //dd($user);

        if($user->status==0){
            $user->status = 1;
        }else{
            $user->status = 0;
        }

        if($user->save()){
            return [
                'error' => 0
            ];
        }else{
            return [
                'error' => 1
            ];
        }
    }


    public function destroy(AdminUser $user) {
        if($user->delete()){
            return [
                'error'=>0
            ];
        }else{
            return [
                'error'=>1
            ];
        }
    }
}
