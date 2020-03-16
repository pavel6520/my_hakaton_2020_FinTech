<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth extends Controller
{
    public function continue(){
        session()->regenerate();
        return response()->json(\request()->session()->all());
        if(\request()->session()->has('access_token') && \request()->session()->has('logined'))
            return redirect('/api/info');
        else if(\request()->session()->has('access_token'))
            return redirect('/api/signin');


    }
}
