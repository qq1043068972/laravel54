<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $table = 'fans';
    protected $primaryKey = 'id';
    protected $fillable = ['fan_id','star_id'];

    public function fuser() {
        return $this->hasOne(User::class,'id','fan_id');
    }

    public function suser() {
        return $this->hasOne(User::class,'id','star_id');
    }


}
