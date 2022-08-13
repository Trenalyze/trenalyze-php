<?php 


namespace Trenalyze\Validator;


class Validator {
    static function validateUrl($url) {
        $url = filter_var($url, FILTER_VALIDATE_URL);
        if ($url === false) {
            $info = [
                'status' => false,
                'message' => 'Oops Media url Must be a valid URL'
            ];
            
            return json_encode($info);
        } else {
            $info = [
                'status' => true,
                'message' => 'Valid URL'
            ];
            
            return json_encode($info);
        }
    }

    static function validateDebug($debug) {
        $validate = filter_var($debug, FILTER_VALIDATE_BOOLEAN);
        if ($validate === false) {
            $info = [
                'status' => false,
                'message' => 'Debug value must be a Boolean'
            ];
            
            return json_encode($info);
        } else {
            $info = [
                'status' => true,
                'message' => 'Valid debug value'
            ];
            
            return json_encode($info);
        }
    }

    static function validateButtons($buttons) {
        if (is_array($buttons)) {
            $info = [
                'status' => true,
                'message' => 'Buttons are valid'
            ];

            return json_encode($info);
        } else {
            $info = [
                'status' => false,
                'message' => 'Buttons must be an Array'
            ];

            return json_encode($info);
        }
    }

    /* Validating the sender to make sure it is a valid WhatsApp number. */
    static function validateSender($sender) {
        /* Validating the sender to make sure it is a valid WhatsApp number. */
        $sender = filter_var($sender, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => '/^[0-9]{11,15}$/'
            ]
        ]);
        /* Checking if the sender is a valid WhatsApp number. */
        if ($sender === false) {
           /* An array that contains the status of the validation and the message. */
            $info = [
                'status' => false,
                'message' => 'Sender is not a valid WhatsApp Number'
            ];
            
            /* Returning the array as a json object. */
            return json_encode($info);
        } else {
           /* An array that contains the status of the validation and the message. */
            $info = [
                'status' => true,
                'message' => 'Valid sender'
            ];
           /* Returning the array as a json object. */
            return json_encode($info);
        }
    }

    /* Validating the token. */
    static function validateToken($token) {
        /* Validating the token to make sure it is a valid token. */
        $token = filter_var($token, FILTER_VALIDATE_REGEXP, [
            // A regular expression that checks if the token is a valid token.
            'options' => [
                'regexp' => '/^[a-zA-Z0-9]{20}$/'
            ]
        ]);
       /* Checking if the token is valid. */
        if ($token === false) {
           /* An array that contains the status of the validation and the message. */
            $info = [
                'status' => false,
                'message' => 'Invalid Token. Visit Trenalyze to get a token'
            ];
            
            /* Returning the array as a json object. */
            return json_encode($info);
        } 
        /* Returning a json object that contains the status of the validation and the message. */
        else {
            /* An array that contains the status of the validation and the message. */
            $info = [
                'status' => true,
                'message' => 'Valid token'
            ];

            /* Returning the array as a json object. */
            return json_encode($info);
        }
    }


    /* Validating the api url. */
    static function validateApiUrl($apiUrl) {
       /* Validating the url to make sure it is a valid url. */
        $url = filter_var($apiUrl, FILTER_VALIDATE_URL);

        /* Checking if the url is valid and if it is, it checks if the url is the default url. */
        if ($url) {
            /* Checking if the api url is the default url. */
            if ($apiUrl === 'https://trenalyze.com/api') {
                /* An array that contains the status of the validation and the message. */
                $info = [
                    'status' => true,
                    'message' => 'Valid API URL'
                ];

                /* Returning the array as a json object. */
                return json_encode($info);
            } else {

                /* An array that contains the status of the validation and the message. */
                $info = [
                    'status' => false,
                    'message' => 'Invalid API URL. It must be https://trenalyze.com/api'
                ];

                /* Returning the array as a json object. */
                return json_encode($info);
            }
        } else {
            $info = [
                'status' => false,
                'message' => 'Invalid API URL. Please don\'t Change the Default'
            ];
            /* Returning the array as a json object. */
            return json_encode($info);
        }
    }
}