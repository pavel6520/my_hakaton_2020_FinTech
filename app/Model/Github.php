<?php

namespace App\Model;

class Github
{
    public static function gettoken($code){
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://github.com/login/oauth/access_token',
                [
                    'json' => [
                        'client_id' => config('global.oauth.client_id'),
                        'client_secret' => config('global.oauth.client_secret'),
                        'code' => $code
                    ]
                ]);
            parse_str($response->getBody()->getContents(), $res);
            return $res['access_token'];
        }
        catch (\Exception $e){
            return false;
        }
    }

    public static function getuserinfo($token){
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://api.github.com/user',
                [
                    'headers'=> [
                        'Authorization' => 'Bearer '.$token
                    ]
                ]);
            return json_decode($response->getBody()->getContents());
        }
        catch (\Exception $e){
            return false;
        }
    }
}
