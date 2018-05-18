<?php

namespace App\core\validation;
use App\core\database\MysqlDatabase;
use App\core\database\SqliteDatabase;
class Validation
{
    private static $config =null;

    public function __construct()
    {
        if(self::$config == null){
            self::$config=include _BASEFILE_.'/config/validation.php';
        }
    }

    public function checkMatch($pattern,$subject){

        return preg_match($pattern, $subject)? true:false;

    }

    public function email($text){
        if($this->checkMatch(self::$config['email']['pattern'],$text)){
            return true;
        }else{
            return self::$config['email']['message'];

        }
    }

    public function alpha($text){
        if($this->checkMatch(self::$config['alpha']['pattern'],$text)){
            return true;
        }else{
            return self::$config['alpha']['message'];

        }
    }
    public function digit($text){
        if($this->checkMatch(self::$config['digit']['pattern'],$text)){
            return true;
        }else{
            return self::$config['digit']['message'];

        }
    }

    public function lengthBetween($text,$min,$max){

        if($min == $max && strlen($text) != $min  ){
            return "the length should be  $min ";
        }
        if(strlen($text) < $min  ){
            return "the length should be more than $min ";
        }


        if( strlen($text) > $max ){
            return "the length should be less than $max";
        }
            return true;

    }

    public function phone($text){
        if($this->checkMatch(self::$config['phone']['pattern'],$text)){
            return true;
        }else{
            return self::$config['phone']['message'];

        }
    }
}