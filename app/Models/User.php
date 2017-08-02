<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //用户文章列表
    public function posts() {
        return $this->hasMany(Post::class,'user_id','id');
    }

    //关注我的人
    public function fans() {
        return $this->hasMany(Fan::class,'star_id','id');
    }

    //我关注的人
    public function stars() {
        return $this->hasMany(Fan::class,'fan_id','id');
    }

    //我要关注某人
    public function doFan($id) {
        $fan = new Fan();
        $fan->star_id = $id;
        $fan->fan_id  = Auth::id();
        return $fan->save();
    }

    //取消关注
    public function doUnFan($id) {

        $star = Fan::where('star_id',$id)->where('fan_id',Auth::id())->first();
        return $star->delete();
    }

    //当前用户是否被粉了
    public function hasFan($id) {
        return $this->fans()->where('fan_id',$id)->count();
    }

    //当前用户是 否关注某个id
    public function hasStar($id) {
        return $this->stars()->where('star_id',$id)->count();
    }



}

