<?php
namespace  App\modules\register\controllers;

use App\core\controllers\BaseModules;
use App\modules\register\validation\Register;
use App\modules\register\validation\VerifySms;
use App\core\tools\Request;
use App\modules\register\repository\Database;
use App\core\sms\SMS;


class Main extends BaseModules{

    public  $messageList=[];

    protected $moduleName='register';

    private $dbRepo;
    private $sms;
    private $validateRegister;
    private $validateVerify;




    /**
     * inject dependency to class to use them
     *
     * @param Database $dbRepo, SMS $sms, Register $validateRegister, VerifySms $validateVerify
     *
     * @throws
     * @author E.Mohammad <taylorsuccessor@gmail.com>
     * @return null
     */
    public function __construct(
        $dbRepo = null,
        $sms = null,
        $validateRegister = null,
        $validateVerify = null)
    {

        $this->dbRepo=($dbRepo == null)? new Database():$dbRepo;
        $this->sms=($sms == null)? new SMS():$sms;
        $this->validateRegister=($validateRegister == null )? new  Register():$validateRegister;
        $this->validateVerify= ($validateVerify ==null)? new VerifySms(): $validateVerify;
    }

    /**
     * render index.php file as html file
     *
     * @param
     *
     * @throws
     * @author E.Mohammad <taylorsuccessor@gmail.com>
     * @return null
     */
    public function index( ){

        $viewPath=  _BASEFILE_.'/modules/'.$this->moduleName.'/views/index.php';
        self::renderViewOrDefault($viewPath,'index',['messageList'=>$this->messageList]);

    }

    /**
     * just determined if the register button click or verify phone number
     *
     * @param
     *
     * @throws database  or  curl error
     * @author E.Mohammad <taylorsuccessor@gmail.com>
     * @return null
     */
    public function postIndex( ){
         if(Request::get('submit')=='verify' ){
            $this->verify();
        }else {
            $this->register();
        }

        $this->index();
    }


    /**
     * validate user data and complete user registeration
     *
     * @param
     *
     * @throws database    error
     * @author E.Mohammad <taylorsuccessor@gmail.com>
     * @return null
     */
    public function register(){
        $this->messageList = $this->validateRegister->validateResult();

        if( count($this->messageList)==0){
            $this->messageList['registerResult'] = $this->dbRepo->updateUser(Request::getRequestData() );
        }

    }


    /**
     * generate verification code and send it user phone
     *
     * @param
     *
     * @throws database  error or curl error
     * @author E.Mohammad <taylorsuccessor@gmail.com>
     * @return null
     */

    public function verify(){
        $this->messageList=$this->validateVerify->validateResult( );
        if( !count($this->messageList)){
            $this->messageList['verifyResult']=$this->sendVerifyCode(Request::get('phone'));
        }

    }



    /**
     * insert or update user verification code and send it to mobile
     *
     * @param String $phone
     *
     * @throws database  error or curl error
     * @author E.Mohammad <taylorsuccessor@gmail.com>
     * @return Boolean
     */
    private function sendVerifyCode($phone){

        $verificationCode = $this->dbRepo->getVerificationCode($phone);
        $sendResult=false;
        if($verificationCode) {
            $sendResult =$this->sms->send($phone, 'your verification is  ' . $verificationCode);

        }
        return $verificationCode && $sendResult;


    }





}