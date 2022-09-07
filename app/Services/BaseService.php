<?php

namespace App\Services;

class BaseService
{
    public function load($data):array {
        $res = [];
        foreach ($data as $key=>$value){
            $pos = strpos($key, "_");
            $locale = substr($key, $pos+1);
            if(in_array($locale,config('translatable.locales'))){
                $res[$locale][strtok($key,'_')] = $value;
            }
            else{
                $res[$key] = $value;
            }
        }
        return $res;
    }
}
