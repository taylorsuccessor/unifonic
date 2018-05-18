<?php
namespace  App\modules\register\repository;

use App\core\database\ConnectDatabase as CDB;
class Database{



    public   function updateUser($data){

       $query="update user set 
               first_name='".$data['first_name']."',last_name='".$data['last_name']."',email='".$data['email']."'  
               where 
               phone = '".$data['phone']."'";

       $result= CDB::query($query);

        return $result ? true:false;
    }


    public   function getVerificationCode($phone){

        $verificationCode=rand(1000,9999);
        $result= CDB::query("select verification_code from user where phone = '$phone'");

        $setVerificationCodeResult= false;

        if($result->fetchArray() ){
            $setVerificationCodeResult= CDB::query("update user set verification_code= '$verificationCode' where phone = '$phone'");
        }else{

            $setVerificationCodeResult= CDB::query("insert into user(phone,verification_code) values ('$phone','$verificationCode')");

        }

        return ($setVerificationCodeResult)? $verificationCode:false;
    }




    public   function validateVerificationCode($phone,$verificationCode){

        $result= CDB::query("select verification_code from user where phone = '$phone' and verification_code ='$verificationCode'");

        return $result->fetchArray()? true: false;
    }

}