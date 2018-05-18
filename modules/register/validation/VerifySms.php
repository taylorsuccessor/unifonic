<?php

namespace  App\modules\register\validation;

use App\core\validation\Validation;

class VerifySms
{
    public static function validateResult($data)
    {
        $errorList=[];
       $validation = new Validation();




        $phoneValidation = $validation->phone($data['phone']);
        if($phoneValidation !== true){
            $errorList['phone'][]=$phoneValidation;
        }



        return $errorList;
    }


}