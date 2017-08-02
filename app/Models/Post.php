<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
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

    //属于某个作者的文章
    public function scopeAuthorBy($query,$user_id) {
        return $query->where('user_id',$user_id);
    }

    public function postTopics() {
        return $this->hasMany(PostTopic::class,'post_id','id');
    }

    //不属于某个专题的文章
    public function scopeTopicNotBy($query,$topic_id) {
        return $query->doesntHave('postTopics','and',function($q) use($topic_id){
            $q->where('topic_id',$topic_id);
            //dd($q->where('topic_id',$topic_id));
        });
    }




}
