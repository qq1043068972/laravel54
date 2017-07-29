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

}
