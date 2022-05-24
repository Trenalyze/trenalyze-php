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

    static function validateSender($sender) {
        $sender = filter_var($sender, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => '/^[0-9]{11,15}$/'
            ]
        ]);
        if ($sender === false) {
            $info = [
                'status' => false,
                'message' => 'Sender is not a valid WhatsApp Number'
            ];
            
            return json_encode($info);
        } else {
            $info = [
                'status' => true,
                'message' => 'Valid sender'
            ];
            return json_encode($info);
        }
    }

    static function validateToken($token) {
        $token = filter_var($token, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => '/^[a-zA-Z0-9]{20}$/'
            ]
        ]);
        if ($token === false) {
            $info = [
                'status' => false,
                'message' => 'Invalid Token. Visit Trenalyze to get a token'
            ];
            
            return json_encode($info);
        } else {
            $info = [
                'status' => true,
                'message' => 'Valid token'
            ];
            return json_encode($info);
        }
    }

    static function validateApiUrl($apiUrl) {
        $url = filter_var($apiUrl, FILTER_VALIDATE_URL);
        if ($url) {
            if ($apiUrl === 'https://api.trenalyze.com') {
                $info = [
                    'status' =>true,
                    'message' => 'Valid API URL'
                ];

                return json_encode($info);
            } else {
                $info = [
                    'status' => false,
                    'message' => 'Invalid API URL. It must be https://api.trenalyze.com'
                ];

                return json_encode($info);
            }
        } else {
            $info = [
                'status' => false,
                'message' => 'Invalid API URL. Please don\'t Change the Default'
            ];
            return json_encode($info);
        }
    }

    static function validateAppUrl($appUrl) {
        $url = filter_var($appUrl, FILTER_VALIDATE_URL);
        if ($url) {
            if ($appUrl === 'https://trenalyze.com') {
                $info = [
                    'status' =>true,
                    'message' => 'Valid App URL'
                ];

                return json_encode($info);
            } else {
                $info = [
                    'status' => false,
                    'message' => 'Invalid APP URL. Please don\'t Change the Default'
                ];

                return json_encode($info);
            }
        } else {
            $info = [
                'status' => false,
                'message' => 'Invalid APP URL. Please don\'t Change the Default'
            ];
            return json_encode($info);
        }
    }
}