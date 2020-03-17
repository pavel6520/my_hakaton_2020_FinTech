<?php

namespace App\Http\Controllers;

use App\Model\Github;

class Auth extends Controller
{
    public function continue(){
        if(session()->has('accesstoken') && session()->has('logined'))
            return redirect('/api/info');
        else if(!session()->has('accesstoken'))
            return redirect('/api/signin');

        $github = Github::getuserinfo(session()->get('accesstoken'));

        return $github;
    }
}
