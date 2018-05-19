<?php

namespace  App\modules\register\validation;

use App\core\validation\Validation;

use App\modules\register\repository\Database;

use App\core\tools\Request;
class Register
{

    private $dbRepo;
    public function __construct(  $dbRepo=null )
    {

        $this->dbRepo=$dbRepo == null? new Database():$dbRepo;
    }

    public  function validateResult()
    {
        $errorList=[];
       $validation = new Validation();

        $emailValidation = $validation->email(Request::get('email'));
        if($emailValidation !== true){
            $errorList['email'][]=$emailValidation;
        }


        $emailLengthValidation = $validation->lengthBetween(Request::get('email'),7,20);
        if($emailLengthValidation !== true){
            $errorList['email'][]=$emailLengthValidation;
        }




        $phoneValidation = $validation->phone(Request::get('phone'));
        if($phoneValidation !== true){
            $errorList['phone'][]=$phoneValidation;
        }
        $first_nameValidation = $validation->alpha(Request::get('first_name'));
        if($first_nameValidation !== true){
            $errorList['first_name'][]=$first_nameValidation;
        }

        $last_nameValidation = $validation->alpha(Request::get('last_name'));
        if($last_nameValidation !== true){
            $errorList['last_name'][]=$last_nameValidation;
        }
        $verification_codeValidation = $validation->lengthBetween(Request::get('verification_code'),4,4);
        if($verification_codeValidation !== true){
            $errorList['verification_code'][]=$verification_codeValidation;
        }
        $verification_codeValidation = $validation->digit(Request::get('verification_code'));
        if($verification_codeValidation !== true){
            $errorList['verification_code'][]=$verification_codeValidation;
        }

        $verification_codeValidation = $this->dbRepo->validateVerificationCode(Request::get('phone'),Request::get('verification_code'));
        if($verification_codeValidation !== true){
            $errorList['verification_code'][]='error, verification code not exist';
        }


        return $errorList;
    }


}