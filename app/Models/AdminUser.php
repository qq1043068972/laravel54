<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'admin_users';
    protected $primaryKey = 'id';
    protected $fillable = ['name','email','password'];
    protected $dates = ['delete_at'];
}
