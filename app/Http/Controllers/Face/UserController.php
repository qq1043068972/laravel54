<?php

namespace App\Http\Controllers\Face;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function setting() {
        return view('face.user.setting');
    }

    public function settingStore() {
        
    }
}
