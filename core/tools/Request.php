<?php
namespace  App\core\tools;


class Request {

    private static $requestData=null;



    public static function setRequestData($requestData=null){

        self::$requestData =($requestData ==null)?  $_POST + $_GET:$requestData;

    }

    public static function getRequestData(){

        if(self::$requestData ==null){
            self::setRequestData();
        }
        return self::$requestData;
    }

    public static function get($param){

        if(self::$requestData ==null){
            self::setRequestData();
        }


        if(array_key_exists($param,self::$requestData)){
             return self::$requestData[$param];
        }
        return '';
    }


}

