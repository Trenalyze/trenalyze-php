<?php

namespace Trenalyze;

class Trenalyze {
    public function __construct($token, $sender) {
        $this->token = $token;
        $this->sender = $sender;
    }

    public function getToken() {
        return $this->token;
    }

    public function getSender() {
        return $this->sender;
    }

    public function sendMessage($receiver, $message, $buttons = '', $mediaurl = '') {
        $url = 'https://api.trenalyze.com';
        $data = [
            'receiver'  => $receiver,
            'msgtext'   => $message,
            'sender'    => $this->sender,
            'token'     => $this->token,
            'appurl'    => self::appurl(),
            'mediaurl'  => $mediaurl,
            'buttons'   => $buttons,
        ];
        $path = '/send';
        
        return self::curlRequest($data, $url, $path); // Return the result
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
        curl_close($ch);
        return $response; 
    }   

    private static function appurl(){
        return 'https://trenalyze.com';
    }
}
