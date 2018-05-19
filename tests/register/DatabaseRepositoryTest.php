<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


use App\core\tools\Request;
use App\modules\register\controllers\Main;
use App\modules\register\repository\Database;
use App\core\database\ConnectDatabase as CDB;

$verification_code='';

final class DatabaseRepositoryTest extends TestCase
{

private $phone='962786846734';

    public   function testGetVerificationCode(){

        $database= new Database();


        $insertedVerificationCode = $database->getVerificationCode($this->phone);
        global  $verification_code;
        $verification_code = $insertedVerificationCode;
        $insertingResult =CDB::query("select * from user where phone = '$this->phone' and verification_code = '$insertedVerificationCode'");

        $this->assertTrue($insertingResult->fetchArray() ? true:false) ;
    }










    public   function testValidateVerificationCode(){

        $database= new Database();
        global  $verification_code;

        $result=$database->validateVerificationCode($this->phone,$verification_code);

       $this->assertTrue($result  );
    }



    public   function testUpdateUser(){


        $database= new Database();

        $result=$database->updateUser(['first_name'=>'my name xxx','last_name'=>'last','email'=>'last@last.com','phone'=>$this->phone]);

        $this->assertTrue($result  );

        $insertingResult =CDB::query("select * from user where first_name = 'my name xxx' and phone = '$this->phone'");
        $this->assertTrue($insertingResult->fetchArray() ? true:false) ;

    }






}

