<?php

namespace helpers;

class Str{

    public static function limit($str)
    {
        if(strlen($str)>20)
        {
            //substr($str , 0 , 20)
            $str = substr($str, 0 ,20).'...';
        }
        return $str;
    }

}


?>