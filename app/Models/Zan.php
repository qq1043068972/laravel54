<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    use SoftDeletes;
    protected $table = 'zans';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','post_id'];

    public function post() {
        return $this->belongsTo(Post::class,'post_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
