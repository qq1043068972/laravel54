<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTopic extends Model
{
    use SoftDeletes;
    protected $table = 'post_topics';
    protected $primaryKey = 'id';
    protected $fillable = ['topic_id','post_id'];
}
