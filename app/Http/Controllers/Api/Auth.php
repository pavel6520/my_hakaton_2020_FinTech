<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Auth extends Controller
{
    public function signin(){
        session()->start();
        if(session()->has('access_token'))
            return redirect('/auth/continue');
        else
            return redirect('https://github.com/login/oauth/authorize?client_id='.config('global.oauth.client_id'));
    }
    public function redirect(){
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://github.com/login/oauth/access_token',
            [
                'json'=>[
                    'client_id'=>config('global.oauth.client_id'),
                    'client_secret'=>config('global.oauth.client_secret'),
                    'code'=>\request()->code
                ]
            ]);
        parse_str($response->getBody()->getContents(), $res);
        try {
            $token = $res['access_token'];
        }
        catch (\Exception $e){
            return redirect('/api/signin');
        }
        session()->start();
        session(['access_token'=>$token]);
        return redirect('/auth/continue');
    }
}
