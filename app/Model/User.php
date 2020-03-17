<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class User
{
    public $login;
    public $qrsecret;

    public function __construct($login)
    {
        $obj = DB::table('user')
            ->where('login', '=', $login)
            ->first();

        if($obj !== null){
            $this->login = $obj->login;
            $this->qrsecret = $obj->qrsecret;
        }
        else {
            DB::table('user')
                ->insert(['login'=>$login]);
        }
    }

    public function setQRSecret($qrsecret){
        DB::table('user')
            ->where('login', '=', $this->login)
            ->update(['qrsecret'=>$qrsecret]);
        $this->qrsecret = $qrsecret;
    }
}
