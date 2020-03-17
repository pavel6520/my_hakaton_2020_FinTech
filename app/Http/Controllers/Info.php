<?php

namespace App\Http\Controllers;

use App\Model\Github;
use App\Model\User;
use Illuminate\Http\Request;

class Info extends Controller
{
    public function index(){
        if (!session()->has('servicetoken')){
            return redirect('/');
        }
        if(!session()->has('logined'))
            return redirect('/continue');

        if(session()->get('service') == 'github') {
            $github = Github::getuserinfo(session()->get('servicetoken'));
            $user = new User($github->login);
            $user->email = $github->email;
            $user->url = $github->html_url;
            $user->avatar = $github->avatar_url;
        }
        else{
            return response('', 501);
        }
        return view('info', ['user'=>$user]);
    }
    public function json(){
        if(session()->has('logined')) {
            if (session()->get('service') == 'github') {
                $github = Github::getuserinfo(session()->get('servicetoken'));
                $user = new User($github->login);
                $user->email = $github->email;
                $user->url = $github->html_url;
                $user->avatar = $github->avatar_url;

                return response()->json($user, 200);
            } else {
                return response('', 501);
            }
        }
        return response('', 401);
    }
}
