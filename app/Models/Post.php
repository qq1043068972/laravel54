<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function comments() {
        return $this->hasMany(Comment::class,'post_id','id');
    }

}
