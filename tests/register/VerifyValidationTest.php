<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use App\core\tools\Request;
use App\modules\register\controllers\Main;
use App\modules\register\validation\Register;
use App\modules\register\validation\VerifySms;



final class VerifyValidationTest extends TestCase
{





    public function testPhoneIsJordinianInVerify()
    {

        $mainController=new Main();


        Request::setRequestData(['phone'=>'962785181656' ]);
        $mainController->verify();
        $this->assertArrayNotHasKey('phone', $mainController->messageList);


        Request::setRequestData(['phone'=>'96278518165' ]);
        $mainController->verify();
        $this->assertArrayHasKey('phone', $mainController->messageList);

        Request::setRequestData(['phone'=>'9627851816566' ]);
        $mainController->verify();
        $this->assertArrayHasKey('phone', $mainController->messageList);


        Request::setRequestData(['phone'=>'662785181656' ]);
        $mainController->verify();
        $this->assertArrayHasKey('phone', $mainController->messageList);

        Request::setRequestData(['phone'=>'96278518M656' ]);
        $mainController->verify();
        $this->assertArrayHasKey('phone', $mainController->messageList);

    }


}

