<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = ['content','user_id','post_id'];

    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
