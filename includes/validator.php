<?php 


namespace Trenalyze\Validator;


class Validator {
    public function validateUrl($url) {
        $url = filter_var($url, FILTER_VALIDATE_URL);
        if ($url === false) {
            return false;
        }
        return true;
    }

    public function validateDebug($debug) {
        $validate = filter_var($debug, FILTER_VALIDATE_BOOLEAN);
        if ($validate === false) {
            return false;
        } else {
            return true;
        }
    }
}