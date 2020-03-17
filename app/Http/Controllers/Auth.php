<?php

namespace App\Http\Controllers;

use App\Authenticator;
use App\Model\Github;
use App\Model\User;

class Auth extends Controller
{
    public function continue()
    {
        if (session()->has('accesstoken') && session()->has('logined'))
            return redirect('/api/info');
        else if (!session()->has('accesstoken'))
            return redirect('/api/signin');

        $github = Github::getuserinfo(session()->get('accesstoken'));

        $user = new User($github->login);

        $a = new Authenticator();
        $title = 'pavel6520_hakaton_fTechLab';
        if ($user->qrsecret == null) {
            $user->setQRSecret($a->generateRandomSecret());
            $qrCodeUrl = $a->getQR($user->login, $user->qrsecret, $title);

            return view('continue', ['url'=>$qrCodeUrl]);
        } else {
            if(isset(request()->code)){
                if($a->getCode($user->qrsecret) == request()->code){
                    session()->put('logined', 1);
                    return true;
                }
                else
                    return view('continue', []);
            }
            else
                return view('continue', []);
        }
        //$qr_url = $google2fa->getQRCodeUrl('pavel6520_hakaton_ftechlab_2020', $user->login, $user->qrsecret);
    }
}
