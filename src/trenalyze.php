<?php

/* A way to organize your code. It is a way to group your code. */
namespace Trenalyze;

/* Including the validator.php file. */
require_once __DIR__ . '/../includes/validator.php';

/* Importing the Validator class from the Validator.php file. */
use Trenalyze\Validator\Validator;


/* It sends a WhatsApp message to a given number. */
class Trenalyze {

    /* Declaring a variable. */
    public $debug;

    /* Declaring a variable. */
    public $sender;

    /* Declaring a variable. */
    public $token;
    
   /**
    * The function __construct() is a special function that is called when an object is created. 
    * 
    * The function __construct() is a special function that is called when an object is created. 
    * 
    * The function __construct() is a special function that is
    * 
    * @param $token 'The token you get from the botfather
    * @param $sender 'The phone number you want to send the message from.
    * @param $debug 'If set to true, the script will output the response from the API.
    */
    public function __construct($token = '', $sender = '', $debug = false) {

       /* Assigning the value of the token variable to the ->token variable. */
        $this->token = $token;

       /* Assigning the value of the  sender variable to the ->sender variable. */
        $this->sender = $sender;

        /* Assigning the value of the  debug variable to the ->debug variable. */
        $this->debug = $debug || false;
    }

   /**
    * If the token is valid, return the token. If the token is invalid, return a 400 status code.
    * 
    * @param $token 'The token you want to validate'.
    * @param $debug true/false
    * 
    * @return 'The token is being returned'.
    */
    private static function getToken($token, $debug) {
        /* Decoding the json string into an object. */
        $validate = json_decode(Validator::validateToken($token));

        /* Validating the token. If the token is valid, it returns the token. If the token is invalid,
        it returns a 400 status code. */
        if ($validate->status) {

           /* Returning the token. */
            return $token;
        } else {

           /* Creating an array. */
            $info = [

                /* Returning a 400 status code. */
                'statusCode' => 400
            ];

            /* Checking if the debug variable is set to true. If it is set to true, it will output the
            response from the API. */
            if ($debug) {

               /* Assigning the value of the ->message variable to the ['message']
               variable. */
                $info['message'] = $validate->message;
            }

            /* if error, Then kill the process */
            die(json_encode($info));
        }
    }

  /**
   * It takes a URL, validates it, and returns the URL if it's valid.
   * 
   * @param $mediaurl 'The URL of the media you want to download.
   * @param $debug true/false
   * 
   * @return 'the  variable.
   */
    private static function getMediaUrl($mediaurl, $debug) {
        $validate = json_decode(Validator::validateUrl($mediaurl));
        if ($validate->status) {
            return $mediaurl;
        } else {
            $info = [
                'statusCode' => 400
            ];

            if ($debug) {
                $info['message'] = $validate->message;
            }
            die(json_encode($info));
        }
    }

    /**
     * It takes an array of buttons, validates them, and returns the array of buttons.
     * 
     * @param $buttons' An array of buttons.
     * @param $debug boolean, if true, will return the error message in the response.
     * 
     * @return 'the  variable.
     */
    private static function getButtons($buttons, $debug) {
        $validate = json_decode(Validator::validateButtons($buttons));
        if ($validate->status) {
            return $buttons;
        } else {
            $info = [
                'statusCode' => 400
            ];

            if ($debug) {
                $info['message'] = $validate->message;
            }
            die(json_encode($info));
        }
    }

  /**
   * If the sender is valid, return the sender. If not, return a 400 status code
   * 
   * @param $sender 'The sender ID to be used for sending the message.
   * @param $debug true/false
   * 
   * @return 'the sender.
   */
    private static function getSender($sender, $debug) {
        $validate = json_decode(Validator::validateSender($sender));
        if ($validate->status) {
            return $sender;
        } else {
            $info = [
                'statusCode' => 400
            ];

            if ($debug) {
                $info['message'] = $validate->message;
            }
            die(json_encode($info));
        }
    }

    private static function apiurl(){
        return 'https://trenalyze.com/api'; // It must be 'https://trenalyze.com/public/api/send'
    }

    private static function getApiUrl($apiUrl, $debug) {
        $validate = json_decode(Validator::validateApiUrl($apiUrl));
        if ($validate->status) {
            return $apiUrl;
        } else {
            $info = [
                'statusCode' => 400
            ];

            if ($debug) {
                $info['message'] = $validate->message;
            }
            die(json_encode($info));
        }
    }

   /**
    * It sends a message to a WhatsApp number
    * 
    * @param $receiver 'The phone number of the person you want to send the message to.
    * @param $message 'The message you want to send to the user.
    * @param $buttons 'This is an array of buttons to be displayed on the message.
    * @param $mediaurl 'This is the URL of the media you want to send. It can be a video, image, audio,
    * or document.
    */
    public function sendMessage($receiver, $message, $buttons = '', $mediaurl = '') {
        if ($mediaurl != '') {
            $mediaurl = self::getMediaUrl($mediaurl, $this->debug);
        }

        if ($buttons !== '') {
            $buttons = self::getButtons($buttons, $this->debug);
        }

        $apiUrl = self::getApiUrl(self::apiurl(), $this->debug);

        $url = $apiUrl;
        $data = [
            'receiver'  => $receiver,
            'msgtext'   => $message,
            'sender'    => self::getSender($this->sender, $this->debug),
            'token'     => self::getToken($this->token, $this->debug),
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

        $info =[
            'statusCode' => $httpcode,
            'message' => $message
        ];
        
        return json_encode($info); // Return the result
    }

/**
 * It takes a data array, a url, and a path, and returns the http code of the response.
 * 
 * @param $data 'The data to be sent to the API.
 * @param $url https://trenalyze.com/api/send
 * @param $path /send
 * 
 * @return 'The HTTP response code.
 */
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
