<?php
namespace  App\core\tools;


class Request {

    private static $requestData=null;



    public static function getRequestData($requestData=null){

        self::$requestData =($requestData ==null)?  $_POST + $_GET:$requestData;
        return self::$requestData;

    }

    public static function get($param){
        if(self::$requestData ==null){
            self::getRequestData();
        }


        if(array_key_exists($param,self::$requestData)){
             return self::$requestData[$param];
        }
        return '';
    }


}

