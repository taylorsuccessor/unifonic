<?php

namespace  App\modules\register\validation;

use App\core\validation\Validation;

use App\modules\register\repository\Database;
class Register
{

    private $dbRepo;
    public function __construct( Database $dbRepo=null )
    {

        $this->dbRepo=$dbRepo == null? new Database():$dbRepo;
    }

    public  function validateResult($data)
    {
        $errorList=[];
       $validation = new Validation();

        $emailValidation = $validation->email($data['email']);
        if($emailValidation !== true){
            $errorList['email'][]=$emailValidation;
        }


        $emailLengthValidation = $validation->lengthBetween($data['email'],7,20);
        if($emailLengthValidation !== true){
            $errorList['email'][]=$emailLengthValidation;
        }




        $phoneValidation = $validation->phone($data['phone']);
        if($phoneValidation !== true){
            $errorList['phone'][]=$phoneValidation;
        }
        $first_nameValidation = $validation->alpha($data['first_name']);
        if($first_nameValidation !== true){
            $errorList['first_name'][]=$first_nameValidation;
        }

        $last_nameValidation = $validation->alpha($data['last_name']);
        if($last_nameValidation !== true){
            $errorList['last_name'][]=$last_nameValidation;
        }
        $verification_codeValidation = $validation->lengthBetween($data['verification_code'],4,4);
        if($verification_codeValidation !== true){
            $errorList['verification_code'][]=$verification_codeValidation;
        }
        $verification_codeValidation = $validation->digit($data['verification_code']);
        if($verification_codeValidation !== true){
            $errorList['verification_code'][]=$verification_codeValidation;
        }

        $verification_codeValidation = $this->dbRepo->validateVerificationCode($data['phone'],$data['verification_code']);
        if($verification_codeValidation !== true){
            $errorList['verification_code'][]='error, verification code not exist';
        }


        return $errorList;
    }


}