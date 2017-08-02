<?php

namespace App\Http\Controllers\Face;

use App\Models\Post;
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

    public function userCentre(User $user) {


        //dd($user);
        //当前用户的 关注/粉丝/文章数
        $userInfo  = User::withCount(['stars','fans','posts'])->find($user->id);

        //当前用户的文章列表
        $posts = Post::where('user_id',$user->id)->orderBy('updated_at','desc')
            ->withCount(['comments','zans'])->paginate(4);
        $posts->load('user');

        //当前用户关注的用户，以及关注用户的  关注/粉丝/文章数
        $stars = $userInfo->stars;
        //dd($stars);
        $susers = User::whereIn('id',$stars->pluck('star_id'))
            ->withCount(['stars','fans','posts'])->get();

        //dd($susers);

        //当前用户的粉丝用户，以及粉丝用户的 关注/粉丝/文章数

        $fans = $userInfo->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))
            ->withCount(['stars','fans','posts'])->get();

        return view('face.user.userCentre',compact('posts','userInfo','susers','fusers'));
    }

    public function userFan(User $user) {
        if($user->doFan($user->id)){
            return [
                'error'=>0,
                'msg'=>''
            ];
        }else{
            return [
                'error'=>1,
                'msg'=>'关注失败'
            ];
        }

    }

    public function userUnFan(User $user) {
        if($user->doUnFan($user->id)){
            return [
                'error'=>0,
                'msg'=>''
            ];
        }else{
            return [
                'error'=>1,
                'msg'=>'关注失败'
            ];
        }
    }


}
