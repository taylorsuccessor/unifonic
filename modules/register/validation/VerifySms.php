<?php

namespace  App\modules\register\validation;

use App\core\validation\Validation;

use App\core\tools\Request;
class VerifySms
{
    public static function validateResult()
    {
        $errorList=[];
       $validation = new Validation();




        $phoneValidation = $validation->phone(Request::get('phone'));
        if($phoneValidation !== true){
            $errorList['phone'][]=$phoneValidation;
        }



        return $errorList;
    }


}