<?php

namespace App\Common\Utils;

class ResponseFormatter
{
    public static function success($message, $collection){
        return ($collection)->additional(['message'=>$message]);
    }
}
