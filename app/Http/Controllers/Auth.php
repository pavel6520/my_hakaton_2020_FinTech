<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth extends Controller
{
    public function continue(){
        if(\request()->session()->has('accesstoken') && \request()->session()->has('logined'))
            return redirect('/api/info');
        else if(!\request()->session()->has('accesstoken'))
            return redirect('/api/signin');

        return 'Token geted!';
    }
}
