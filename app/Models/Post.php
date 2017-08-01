<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use SoftDeletes;

    protected $table      = 'posts';
    protected $primaryKey = 'id';
    protected $fillable   = ['title','content','user_id'];

    protected $dates = ['deleted_at'];

    //获得用户
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    //评论
    public function comments() {
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function zan() {
        //return $this->hasOne(Zans::class)->where('user_id',$user_id);
        return $this->hasOne(Zan::class,'post_id','id')->where('user_id',Auth::id());
    }

    public function zans() {
        return $this->hasMany(Zan::class,'post_id','id');
    }

}
