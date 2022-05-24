<?php 


namespace Trenalyze\Validator;


class Validator {
    public function validateUrl($url) {
        $url = filter_var($url, FILTER_VALIDATE_URL);
        if ($url === false) {
            $info = [
                'status' => false,
                'message' => 'Invalid URL'
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

    public function validateDebug($debug) {
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

    public function validateButtons($buttons) {
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

    public function validateSender($sender) {
        $sender = filter_var($sender, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => '/^\+?[0-9]{11}$/'
            ]
        ]);
        if ($sender === false) {
            $info = [
                'status' => false,
                'message' => 'Sender is not a valid WhatsApp number'
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

    public function validateToken($token) {
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
}