<?php

namespace App\RC;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Lang;

class Trans {

    public static function get($data = "", $key = "ar") {

        $data = @unserialize($data);
        if ($data !== false) {
            $out = $data[$key];
        } else {
            $out = $data;
        }

        return $out;
    }

}
