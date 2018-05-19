<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use App\core\tools\Request;
use App\modules\register\controllers\Main;
use App\modules\register\validation\Register;
use App\modules\register\validation\VerifySms;
use App\tests\alternativeRepository\DatabaseRepository;

final class RegisterValidationTest extends TestCase
{




    public function testVerificationCode4Digit()
    {

        $validationRegister=new Register(new DatabaseRepository() );

        $mainController=new Main(null,null ,$validationRegister);


        Request::setRequestData(['verification_code'=>'3453' ]);
        $mainController->register();
        $this->assertArrayNotHasKey('verification_code', $mainController->messageList);


        Request::setRequestData(['verification_code'=>'345' ]);
        $mainController->register();
        $this->assertArrayHasKey('verification_code', $mainController->messageList);

        Request::setRequestData(['verification_code'=>'34533' ]);
        $mainController->register();
        $this->assertArrayHasKey('verification_code', $mainController->messageList);


        Request::setRequestData(['verification_code'=>'345M' ]);
        $mainController->register();
        $this->assertArrayHasKey('verification_code', $mainController->messageList);

    }




    public function testEmailAllowedShapes()
    {

        $mainController=new Main();

        Request::setRequestData(['email'=>'foo@example.com' ]);
        $mainController->register();
        $this->assertArrayNotHasKey('email', $mainController->messageList);


        Request::setRequestData(['email'=>'foo.noo@example.com' ]);
        $mainController->register();
        $this->assertArrayNotHasKey('email', $mainController->messageList);


        Request::setRequestData(['email'=>'foo_noo@example.com' ]);
        $mainController->register();
        $this->assertArrayNotHasKey('email', $mainController->messageList);

    }


    public function testEmailDoesNotContainSpical()
    {

        $mainController=new Main();


        Request::setRequestData(['email'=>'foo%@example.com' ]);
        $mainController->register();
        $this->assertArrayHasKey('email', $mainController->messageList);

    }

    public function testEmailEndWithCom()
    {

        $mainController=new Main();

        Request::setRequestData(['email'=>'foo@example.con']);
        $mainController->register();
        $this->assertArrayHasKey('email', $mainController->messageList);

    }

    public function testEmailDoesNotAllowCapitalInMiddle()
    {

        $mainController=new Main();

        Request::setRequestData(['email'=>'foo@Example.com' ]);
        $mainController->register();
        $this->assertArrayHasKey('email', $mainController->messageList);

    }




    public function testFirstNameStringBetween2And20()
    {

        $mainController=new Main( );


        Request::setRequestData(['first_name'=>'Name' ]);
        $mainController->register();
        $this->assertArrayNotHasKey('first_name', $mainController->messageList);

        Request::setRequestData(['first_name'=>'N' ]);
        $mainController->register();
        $this->assertArrayHasKey('first_name', $mainController->messageList);


        Request::setRequestData(['first_name'=>'Name2' ]);
        $mainController->register();
        $this->assertArrayHasKey('first_name', $mainController->messageList);

        Request::setRequestData(['first_name'=>'NameNameNameNameNameName' ]);
        $mainController->register();
        $this->assertArrayHasKey('first_name', $mainController->messageList);
    }


    public function testLastNameStringBetween2And20()
    {

        $mainController=new Main( );


        Request::setRequestData(['last_name'=>'Name' ]);
        $mainController->register();
        $this->assertArrayNotHasKey('last_name', $mainController->messageList);

        Request::setRequestData(['last_name'=>'N' ]);
        $mainController->register();
        $this->assertArrayHasKey('last_name', $mainController->messageList);


        Request::setRequestData(['last_name'=>'Name2' ]);
        $mainController->register();
        $this->assertArrayHasKey('last_name', $mainController->messageList);

        Request::setRequestData(['last_name'=>'NameNameNameNameNameName' ]);
        $mainController->register();
        $this->assertArrayHasKey('last_name', $mainController->messageList);
    }



    public function testPhoneIsJordinian()
    {

        $mainController=new Main();


        Request::setRequestData(['phone'=>'962785181656' ]);
        $mainController->register();
        $this->assertArrayNotHasKey('phone', $mainController->messageList);


        Request::setRequestData(['phone'=>'96278518165' ]);
        $mainController->register();
        $this->assertArrayHasKey('phone', $mainController->messageList);

        Request::setRequestData(['phone'=>'9627851816566' ]);
        $mainController->register();
        $this->assertArrayHasKey('phone', $mainController->messageList);


        Request::setRequestData(['phone'=>'662785181656' ]);
        $mainController->register();
        $this->assertArrayHasKey('phone', $mainController->messageList);

        Request::setRequestData(['phone'=>'96278518M656' ]);
        $mainController->register();
        $this->assertArrayHasKey('phone', $mainController->messageList);

    }



}

