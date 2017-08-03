<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use SoftDeletes;
    protected $table = 'topics';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function posts() {
        return $this->belongsToMany(Post::class,'post_topics','topic_id','post_id');
    }

    public function postTopics() {
        return $this->hasMany(PostTopic::class,'topic_id','id');
    }
}
