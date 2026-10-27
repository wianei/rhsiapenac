<?php
/**
 * Created by PhpStorm.
 * User: geova
 * Date: 17/07/2018
 * Time: 12:05
 */

namespace app\Http\Controllers;


class Util
{
    public static function contemNoArray($var, $array){
        if($array == null) return false;
        foreach($array as $item){
            if($item == $var) return true;
        }
        return false;
    }
}