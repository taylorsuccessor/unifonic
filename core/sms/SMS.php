<?php

namespace App\core\sms;
class SMS
{



    public static function send($phone,$message){
        $config=include _BASEFILE_.'/config/sms.php';
        $post = [
            'AppSid' => $config['AppSid'],
            'SenderID' => $config['SenderID'],
            'Recipient' => $phone,
            'Body'   =>$message,
        ];

        $ch = curl_init($config['provider']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);

        curl_close($ch);

        return (self::parseJson($response)['success'] == 'true')? true:false;
    }

    private static function parseJson($text){
        $json=json_decode($text, true);
        return is_array($json)? $json:["success"=>"false"];
        }

}