<?php

namespace App\RC;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use App\RC\Trans;
use Lang;

class Block {

    public static $currentValue;
    private static $instance = null;

    private function __construct() {
        
    }

    public static function creat($trans = false, $title = "") {
        self::$instance = new self;
        self::$currentValue = array();
        self::$currentValue["trans"] = $trans;
        self::$currentValue["title"] = $title;
        return self::$instance;
    }

    public function title($title = "") {
        self::$currentValue["title"] = $title;
        return $this;
    }

    public function span($left = "") {
        self::$currentValue["title_left"] = $left;
        return $this;
    }

    public function btn($btn = false , $button_title = "") {
        self::$currentValue["btn"] = $btn;
        self::$currentValue["button_title"] = $button_title;
        return $this;
    }

    public function inject($content = "") {
        self::$currentValue["content"][] = $content;
        return $this;
    }

    public static function get($view = null) {

        $ArrData = self::$currentValue;
        $title = @$ArrData["title"];
        $title_left = @$ArrData["title_left"];
        $ARRcontent = @$ArrData["content"];
        $trans = @$ArrData["trans"];
        $button_title = @$ArrData["button_title"];
        $btn = @$ArrData["btn"];
        $view = ($view && $view != null) ? $view = $view : RC_urlForm("block");

        if (RC_uri(2) == "form"):
            $btn = true;
        endif;

        $_content = "";
        if (is_array($ARRcontent)):
            foreach ($ARRcontent as $item):
                if (is_array($item)):
                    $_content .= implode("", $item);
                else:
                    $_content .= $item;
                endif;
            endforeach;
        else:
            $_content = "";
        endif;

        if (empty($title) || $title == null || $title == false) {
            $title = RC_lang(RC_uri(2) . "_title");
            if (empty($title)) {
                $url_arr = array();
                $url_arr[] = RC_uri(1);
                $url_arr[] = RC_uri(2);
                $url_arr[] = RC_uri(3);

                $url_form = implode("/", array_filter($url_arr));
                $Rmenu = DB::table("rc_menu")->where("url", $url_form)->where("parent", ">", 0)->first();
                if ($Rmenu) {
                    $title = $Rmenu->title;
                }
            }
        }

        if (empty($title) || $title == null || $title == false) {
            $Rmenu = DB::table("tb_feature_type")->where("name", RC_uri(1))->first();
            if ($Rmenu) {
                if (RC_uri(2) == "index"):
                    $title = $Rmenu->value;
                endif;
                if (RC_uri(3) == "insert"):
                    $title = "إضافة " . $Rmenu->value;
                endif;
                if (RC_uri(3) == "update"):
                    $title = "تعديل " . $Rmenu->value;
                endif;
            }
        }

        $languages = "";
        if ($trans == true) {
            $languages = DB::table("rc_language")->get();
        }

        $data = array();
        $data["content"] = $_content;
        $data["languages"] = $languages;
        $data["title"] = $title;
        $data["trans"] = $trans;
        $data["button"] = $btn;
        $data["button_title"] = $button_title;
        $data["title_left"] = $title_left;
        $out = view($view, $data);
        return $out;
    }

}
