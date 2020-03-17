<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Github;

class Auth extends Controller
{
    public function signin(){
        if(session()->has('accesstoken'))
            return redirect('/auth/continue');
        else
            return redirect('https://github.com/login/oauth/authorize?client_id='.config('global.oauth.client_id'));
    }
    public function redirect(){

            $token = Github::gettoken(\request()->code);

        if($token === false){
            return redirect('/api/signin');
        }
        return redirect('/auth/continue');
    }
}
