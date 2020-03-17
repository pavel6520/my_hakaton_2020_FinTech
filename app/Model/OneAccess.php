<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class OneAccess
{
    public static function add($key, $service, $token){
        DB::table('oneaccess')->insert(['key'=>$key,'service'=>$service,'token'=>$token]);
    }

    public static function get($key){
        $obj = DB::table('oneaccess')
            ->where('key','=',$key)
            ->first();

        if($obj !== null){
            DB::table('oneaccess')
                ->where('key','=',$key)
                ->delete();
        }
        return $obj;
    }
}
