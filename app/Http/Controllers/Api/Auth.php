<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Auth extends Controller
{
    public function signin(){
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
        $token = $res['access_token'];
        return response()->json($token);
    }
}
