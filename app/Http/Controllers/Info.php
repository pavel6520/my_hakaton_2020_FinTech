<?php

namespace App\Http\Controllers;

use App\Model\Github;
use App\Model\OneAccess;
use App\Model\User;
use Illuminate\Http\Request;

class Info extends Controller
{
    public function index(){
        if(isset(\request()->key)){
            $res = OneAccess::get(\request()->key);
            if($res !== null){
                session()->put('service', $res->service);
                session()->put('servicetoken', $res->token);
                session()->put('logined', 1);
            }
        }
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
    public function qr(){
        if (!session()->has('servicetoken')){
            return redirect('/');
        }
        if(!session()->has('logined'))
            return redirect('/continue');

        if(session()->get('service') == 'github') {
            $github = Github::getuserinfo(session()->get('servicetoken'));
            $user = new User($github->login);

            $key = hash_hmac('sha256', time().$user->login, config('app.name'));
            OneAccess::add($key,'github',session()->get('servicetoken'));
            return view('qr', ['key'=>$key]);
        }
        else{
            return response('', 501);
        }
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
