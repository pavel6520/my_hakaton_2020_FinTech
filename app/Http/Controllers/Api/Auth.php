<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Auth extends Controller
{
    public function signin(){
        return redirect('https://github.com/login/oauth/authorize?client_id='.config('global.oauth.client_id'));
    }
}
