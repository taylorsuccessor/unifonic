<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use App\core\tools\Request;
use App\modules\register\controllers\Main;
use App\modules\register\validation\Register;
use App\modules\register\validation\VerifySms;



final class MainSendVerifyCodeTest extends TestCase
{

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }



    public function testSendVerifyCode()
    {

        $mainController=new Main();

       $sendSuccessResult = $this->invokeMethod($mainController, 'sendVerifyCode', array('962785181656'));

        $this->assertTrue($sendSuccessResult);

        $sendErrorResult = $this->invokeMethod($mainController, 'sendVerifyCode', array('errorphone'));

        $this->assertFalse($sendErrorResult);

    }


}

