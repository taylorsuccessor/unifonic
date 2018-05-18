<?php
namespace App\core\controllers;



class Api{

    private $MT4_SERVER='';
    private $MT4_PORT='';

    public $config=array();

    public function __construct($message=''){

$config= include _BASEFILE_ . '/config/sms.php';

        $this->MT4_SERVER=$config['MT4_SERVER'];
        $this->MT4_PORT=$config['MT4_PORT'];

        $this->config=$config;

    }

    public function sendMessageToApi($message){

        $message= $message."\nQUIT\n";
        $ret='error';
        $ptr=@fsockopen($this->MT4_SERVER,$this->MT4_PORT,$errno,$errstr,5);

        if($ptr) {
            if(fputs($ptr,$message)!=FALSE) {
                $ret='';
                while(!feof($ptr)) {
                    $line=fgets($ptr,12);
                    if($line=="\r\n") break;
                    $ret.= $line;
                }
            }
            fclose($ptr);
        }
        $ret = substr($ret,0,strlen($ret)-1);

        $obj = json_decode($ret);

        $result='error';
        if (!is_null($obj)) {
            $result=$obj->{'result'};

        }
        $returnMessage=$this->config['resultMessage'][$result];


        return [$returnMessage,$obj];
    }

}
