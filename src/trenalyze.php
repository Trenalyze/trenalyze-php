<?php

namespace Trenalyze;

class Trenalyze {
    public function __construct($token, $sender, $debug = false) {
        $this->token = $token;
        $this->sender = $sender;
        $this->debug = $debug || false;
    }

    private static function getToken($token, $debug) {
        return $token;
    }

    private static function getSender($sender, $debug) {
        
        $info = [
            'statusCode' => 400,
            'message' => 'Bad Request'
        ];

        if ($debug) {
            $info['debugMessage'] = 'Sender is not a valid WhatsApp number';
        }

        die(json_encode($info));
       // return $sender;
    }

    private static function appurl(){
        return 'https://trenalyze.com';
    }

    public function sendMessage($receiver, $message, $buttons = '', $mediaurl = '') {
        $url = 'https://api.trenalyze.com';
        $data = [
            'receiver'  => $receiver,
            'msgtext'   => $message,
            'sender'    => self::getSender($this->sender, $this->debug),
            'token'     => self::getToken($this->token, $this->debug),
            'appurl'    => self::appurl(),
            'mediaurl'  => $mediaurl,
            'buttons'   => $buttons,
        ];
        $path = '/send';
        $sendReq = self::curlRequest($data, $url, $path);
        switch ($sendReq) {
            case 200:
                $httpcode = 200;
                $message = 'WhatsApp Message was sent successfully';
                break;
            case 500:
                $httpcode = 500;
                $message = 'Internal Server Error';
                break;
            case 400:
                $httpcode = 400;
                $message = 'Bad Request';
                break;
            case 401:
                $httpcode = 401;
                $message = 'Unauthorized';
                break;
            case 403:
                $httpcode = 403;
                $message = 'Forbidden';
                break;
            case 404:
                $httpcode = 404;
                $message = 'Not Found';
                break;
            default:
                $httpcode = 500;
                $message = 'Internal Server Error';
                break;
        }

        $info = json_encode(array(
            'statusCode' => $httpcode,
            'message' => $message
        ), JSON_THROW_ON_ERROR);

        return $info; // Return the result
    }

    private static function curlRequest($data, $url, $path) {
        $url = "{$url}{$path}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode; 
    }   
}
