<?php

namespace App\RC;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use App\RC\Form;
use Lang;

class Input {

    public static $currentValue;
    private static $instance = null;

    private function __construct() {
        
    }

    public static function creat($input = "textbox", $name = "", $trans = true) {
        self::$instance = new self;
        $currentValue = array();

        self::$currentValue = array();
        self::$currentValue["name"] = $name;
        self::$currentValue["trans"] = $trans;
        self::$currentValue["input_view"] = $input;
        return self::$instance;
    }

    public function type($data) {
        self::$currentValue["type"] = $data;
        return $this;
    }

    public function attr($data = "") {
        self::$currentValue["attr"] = $data;
        return $this;
    }

    public function style($data = "") {
        self::$currentValue["style"] = $data;
        return $this;
    }

    public function class($data = "") {
        self::$currentValue["class"] = " " . $data;
        return $this;
    }

    public function title($title = "", $placeholder = "") {
        self::$currentValue["title"] = $title;
        self::$currentValue["placeholder"] = $placeholder;
        return $this;
    }

    public function allow($ext = ".jpg,.png,.jpg") {
        self::$currentValue["allow"] = $ext;
        return $this;
    }

    public function num($num = 1) {
        self::$currentValue["num"] = $num;
        return $this;
    }

    public function wrap_class($class = "") {
        self::$currentValue["wrap_class"] = $class;
        return $this;
    }

    public function value($value = "") {
        self::$currentValue["value"] = $value;
        return $this;
    }

    public function content($content = "") {
        self::$currentValue["content"] = $content;
        return $this;
    }

    public function hide($hide = true) {
        self::$currentValue["hide"] = $hide;
        return $this;
    }

    public function col($col = 6, $inline = false) {
        self::$currentValue["col"] = $col;
        self::$currentValue["inline"] = $inline;
        return $this;
    }

    public function tbl($stort = 1, $inline = false) {
        self::$currentValue["tbl"] = $stort;
        return $this;
    }

    public function db($where = null, $table = "tb_feature", $column = "title", $key = "id") {
        if (empty($table) || $table == null || $table == false):
            $table = "tb_feature";
        endif;
        if (is_int($where) && $db == "tb_feature"):
            $where = array("feature" => $where);
        endif;
        self::$currentValue["db"] = array("where" => $where, "table" => $table, "column" => $column, "key" => $key);
        return $this;
    }

    public function ajax($input, $relation = "parent", $table = "tb_feature", $column = "title", $val = "id") {

        self::$currentValue["ajax"] = $input;
        self::$currentValue["ajax_relation"] = $relation;
        self::$currentValue["ajax_column"] = $column;
        self::$currentValue["ajax_table"] = $table;
        self::$currentValue["ajax_val"] = $val;

        return $this;
    }

    public function option($text, $value = "") {
        if (is_array($text)):
            self::$currentValue["option"] = $text;
        else:
            self::$currentValue["option"][$value] = $text;
        endif;

        return $this;
    }

    public function check($min = 0, $max = "", $validation = "") {

        $validator = array();
        if ($min > 0) {
            $validator[] = "required|min:$min";
        }
        if ($max > 1) {
            $validator[] = "max:$max";
        }
        if (!empty($validation)) {
            $validator[] = $validation;
        }

        $data = implode("|", $validator);

        self::$currentValue["check"] = $data;
        return $this;
    }

    static function validation($name = "", $validation = "", $type = "", $title = "") {

        $ARRvalidation = explode("|", $validation);

        $error = "";
        $submit = request()->post("submit");
        $request = request()->post();

        $ARRvalidation = explode("|", $validation);
        if ($ARRvalidation[0] == "required" || strlen(request()->post($name)) > 0) {


            if ($type == "email") {
                if ($validation) {
                    $validation .= "|email";
                } else {
                    $validation .= "email";
                }
            }

            if ($type == "tel" || $type == "number") {
                if ($validation) {
                    $validation .= "|numeric";
                } else {
                    $validation .= "numeric";
                }
            }

            if ($type == "url") {
                if ($validation) {
                    $validation .= "|url";
                } else {
                    $validation .= "url";
                }
            }
        }


        $validators["$name"] = $validation;
        $validator = Validator::make($request, [$name => $validation]);
        if ($validator->fails() && $submit) {
            $messages = $validator->messages();
            foreach ($messages->get($name) as $message) {
                $error = div(str_replace('$input_title', $title, $message));

//                $input_other = RC_lang("password_title");

                $input_other_title = @explode("same:", $validation);
                $input_other_title_get = @str_replace('|', "", @$input_other_title[1]);
                $input_other = RC_lang("{$input_other_title_get}_title");
                $error = div(str_replace('$input_other', $input_other, $error));
            }
            session()->flash('success', false);
            session()->flash('error', true);
        } else {
            if (session()->get('error') != true):
                session()->flash('success', true);
                session()->flash('error', false);
            endif;
        }
        return $error;
    }

    public function arr($view = null) {

        $_db = Form::data();

        $ArrData = self::$currentValue;
        $db = @$ArrData["db"];
        $name = (@$ArrData["name"]) ? @$ArrData["name"] : "";
        $hide = (@$ArrData["hide"]) ? @$ArrData["hide"] : false;

        $ARRvalidation = explode("|", @$ArrData["check"]);
        if ($ARRvalidation[0] == "required" || strlen(request()->post($name)) > 0) {
            $check = (@$ArrData["check"]) ? @$ArrData["check"] . "|" . @$ArrData["input_view"]["check"] : @$ArrData["input_view"]["check"];
        } else {
            $check = (@$ArrData["check"]) ? @$ArrData["check"] : "";
        }


        $attr = @$ArrData["attr"];
        $style = @$ArrData["style"];
        $class = @$ArrData["class"] . @$ArrData["input_view"]["class"];
        $col = @$ArrData["col"];
        $num = @$ArrData["num"];
        $allow = @$ArrData["allow"];
        $option = @$ArrData["option"];
        $_content = @$ArrData["content"];
        $value = (@$ArrData["value"]) ? @$ArrData["value"] : "";
        $tbl = (@$ArrData["tbl"]) ? @$ArrData["tbl"] : 0;
        $trans = (@$ArrData["trans"]) ? @$ArrData["trans"] : false;
        $wrap_class = @$ArrData["wrap_class"];
        $inline = @$ArrData["inline"];
        $ajax = @$ArrData["ajax"];
        $ajax_relation = @$ArrData["ajax_relation"];
        $ajax_column = @$ArrData["ajax_column"];
        $ajax_table = @$ArrData["ajax_table"];
        $ajax_val = @$ArrData["ajax_val"];
        $type = (@$ArrData["type"]) ? $type = @$ArrData["type"] : @$ArrData["input_view"]["type"];
        $type = (@$ArrData["input_view"]["type"] == "date") ? "text" : $type;
        $view = ($view && $view != null) ? $view = $view : RC_urlForm(@$ArrData["input_view"]["view"]);
        $title = (@$ArrData["title"]) ? $title = @$ArrData["title"] : RC_lang("{$name}_title");
        if (@$ArrData["input_view"]["view"] == "select"):
            $placeholder = (@$ArrData["placeholder"]) ? $placeholder = @$ArrData["placeholder"] : RC_lang("{$name}_title");
        else:
            $placeholder = (@$ArrData["placeholder"] || @$ArrData["placeholder"] == null) ? $placeholder = @$ArrData["placeholder"] : RC_lang("{$name}_title");
        endif;
        $disc = (@$ArrData["input_view"]["disc"]) ? @$ArrData["input_view"]["disc"] : "";

        /* image and files .. */
        if (@$ArrData["input_view"]["view"] == "upload" && empty($allow)):
            $allow = @$ArrData["input_view"]["allow"];
        endif;
        if (@$ArrData["input_view"]["view"] == "upload" && empty($num)):
            $num = @$ArrData["input_view"]["num"];
        endif;
        /* END image and files .. */

        /* select multi .. */
        if (@$ArrData["input_view"]["type"] == "select_multi"):
            $attr .= " multiple='multiple' ";
        endif;
        /* END select multi .. */

        /* select database */
        $q_select = "";
        $options = "";
        $key = (@$db["key"]) ? @$db["key"] : "id";
        $column = (@$db["column"]) ? @$db["column"] : "title";
        if ($db && !empty($db) && is_array($db)):
            $q_select = DB::table(@$db["table"]);
            if (@$db["where"]):
                //$q_select = RC_dbWhere($q_select, @$db["where"]);
                foreach (@$db["where"] as $k_w => $v_w):

                    if (strpos($v_w, "ajax:") !== false) {
                        $v_w_arr = explode(":", $v_w);
                        $v_w_item = @$v_w_arr[1];
                        if (request()->post("submit")) {
                            $v_w = request()->post($v_w_item);
                        } else {
                            if ($_db->db == "update"):
                                $v_w = @$_db->row->$v_w_item;
                            endif;
                        }
                    }

                    $q_select = $q_select->where($k_w, $v_w);
                endforeach;
            endif;
            $q_select = $q_select;
        endif;
        /* END select database */

        $attribute = "";
        $attribute .= " type='" . $type . "' ";
        $attribute .= " style='" . $style . "' ";
        $attribute .= " placeholder='" . $placeholder . "' ";
        $attribute .= " {$attr} ";

        $ARR_data = array();

        if ($trans == true):
            $q = DB::table("rc_language")->get();
            foreach ($q as $r):
                $pos = strpos($name, "[");
                if ($pos == false):
                    $_name = $name . "_{$r->shortcut}";
                    $_data = " name='" . $_name . "' " . $attribute;
                else:
                    $ARR_name = explode("[", $name);
                    $_name = $ARR_name[0] . "_{$r->shortcut}[" . $ARR_name[1];
                    $_data = " name='" . $_name . "' " . $attribute;
                endif;
                $data["data"] = $_data;
                $data["_name"] = $_name;
                $data["lng"] = $r->shortcut;
                if ($r->active == 0):
                    $_wrap_class = "d-none form_lang_group form_lang_{$r->shortcut} {$wrap_class}";
                else:
                    $_wrap_class = " form_lang_group form_lang_{$r->shortcut} {$wrap_class}";
                endif;
                $error = self::validation($_name, $check, @$ArrData["input_view"]["type"], $title);

                $ARR_data[] = array("name" => $_name, "data" => $_data, "lng" => $r->shortcut, "_lng" => "_" . $r->shortcut, "wrap_class" => $_wrap_class, "error" => $error);
            endforeach;
        else:
            $_data = " name='" . $name . "' " . $attribute;
            $error = self::validation($name, $check, @$ArrData["input_view"]["type"], $title);
            $ARR_data[] = array("name" => $name, "data" => $_data, "lng" => "", "_lng" => "", "wrap_class" => $wrap_class, "error" => $error);
        endif;

        $out = array();
        $content = "";
        $data = array();
        $data["value"] = $value;
        $data["q"] = $q_select;
        $data["db"] = @$db["table"];
        $data["key"] = $key;
        $data["column"] = $column;
        $data["col"] = ($col) ? $col : (($type == "editor") ? 12 : 6);
        $data["wrap_class"] = $wrap_class;
        $data["tbl"] = $tbl;
        $data["inline"] = $inline;
        $data["name"] = $name;
        $data["num"] = $num;
        $data["allow"] = $allow;
        $data["trans"] = $trans;
        $data["option"] = $option;
        $data["title"] = $title;
        $data["placeholder"] = $placeholder;
        $data["class"] = $class;
        $data["disc"] = $disc;
        $data["view"] = $view;
        $data["type"] = $type;
        $data["check"] = $check;
        $data["content"] = $_content;
        $data["attribute"] = $attribute;
        $data["ARR_data"] = $ARR_data;
        $data["ajax"] = $ajax;
        $data["ajax_column"] = $ajax_column;
        $data["ajax_relation"] = $ajax_relation;
        $data["ajax_table"] = $ajax_table;
        $data["ajax_val"] = $ajax_val;

        return $data;
    }

    public function get($view = null) {
        $arr = $this->arr($view);
        $view = @$arr["view"];
        $ARR_data = @$arr["ARR_data"];

        // value ..


        $_db = Form::data();

        $content = "";
        foreach ($ARR_data as $item):
            $data = array();
            $data = $arr;
            $name = $arr["name"];
            $data["lng"] = $item["lng"];
            $data["wrap_class"] = $item["wrap_class"];
            $data["error"] = $item["error"];
            $data["data"] = $item["data"];
            $data["attr"] = array("checked" => "true");
            if ($arr["type"] != "password"):
                if (request()->post("submit")):
                    if (@$arr["type"] == "checkbox") {
                        $data["value"] = $arr["value"];
                    } else {
                        $data["value"] = request()->post($item["name"]);
                    }

                else:
                    if ($_db->db == "update" && empty($arr["value"])):

                        $name_arr = explode("[", $name);
                        $name = $name_arr[0];

                        if (@$arr["type"] == "checkbox") {

                            $__val = RC_trans(@$_db->row->$name, $item["lng"]);
                            if (array_key_exists(1, $name_arr)) {
                                $__val = explode(",", $__val);
                                if (in_array(@$arr["value"], $__val)) {
                                    $data["data"] = $item["data"] . " checked=''";
                                }
                            } else {
                                if (@$arr["value"] == RC_trans(@$_db->row->$name, $item["lng"])) {
                                    $data["data"] = $item["data"] . " checked=''";
                                }
                            }
                        } else {
                            $data["value"] = RC_trans(@$_db->row->$name, $item["lng"]);
                            if (@$arr["disc"] == "map") {
                                $data["map_address"] = RC_trans(@$_db->row->map_address, $item["lng"]);
                            }
                        }
                    endif;
                endif;
            endif;
            $content .= view($view, $data);
        endforeach;

        return $content;
    }

    public function get_($show = false, $view = null) {

        $ArrData = self::$currentValue;

        $db = @$ArrData["db"];
        $name = (@$ArrData["name"]) ? @$ArrData["name"] : "";
        $hide = (@$ArrData["hide"]) ? @$ArrData["hide"] : false;
        $check = @$ArrData["check"];
        $attr = @$ArrData["attr"];
        $style = @$ArrData["style"];
        $class = @$ArrData["class"];
        $col = @$ArrData["col"];
        $num = @$ArrData["num"];
        $allow = @$ArrData["allow"];
        $option = @$ArrData["option"];
        $_content = @$ArrData["content"];
        $value = (@$ArrData["value"]) ? @$ArrData["value"] : "";
        $tbl = (@$ArrData["tbl"]) ? @$ArrData["tbl"] : 0;
        $trans = (@$ArrData["trans"]) ? @$ArrData["trans"] : false;
        $wrap_class = @$ArrData["wrap_class"];
        $inline = @$ArrData["inline"];
        $type = (@$ArrData["type"]) ? $type = @$ArrData["type"] : @$ArrData["input_view"]["type"];
        $type = (@$ArrData["input_view"]["type"] == "date") ? "text" : $type;
        $view = ($view && $view != null) ? $view = $view : RC_urlForm(@$ArrData["input_view"]["view"]);
        $title = (@$ArrData["title"]) ? $title = @$ArrData["title"] : RC_lang("{$name}_title");
        $placeholder = (@$ArrData["placeholde"]) ? $placeholder = @$ArrData["placeholde"] : RC_lang("{$name}_title");
        $disc = (@$ArrData["input_view"]["disc"]) ? @$ArrData["input_view"]["disc"] : "";

        if (@$ArrData["input_view"]["type"] == "date"):
            $class .= $class . "  hijri-date-input";
            if ($check):
                $validation = $check . "|date";
            else:
                $validation = "date";
            endif;
        endif;

        /* image and files .. */
        if (@$ArrData["input_view"]["view"] == "upload" && empty($allow)):
            $allow = @$ArrData["input_view"]["allow"];
        endif;
        if (@$ArrData["input_view"]["view"] == "upload" && empty($num)):
            $allow = @$ArrData["input_view"]["num"];
        endif;
        /* END image and files .. */

        /* select multi .. */
        if (@$ArrData["input_view"]["type"] == "select_multi"):
            $attr .= " multiple='multiple' ";
        endif;
        /* END select multi .. */

        $q = "";
        $options = "";
        if ($db && !empty($db) && is_array($db)):
            $key = @$db["key"];
            $column = @$db["column"];
            $q = DB::table(@$db["table"])->get();
            $q = RC_dbWhere($q, @$db["where"]);
        endif;

        $out = array();
        $content = "";
        $data = array();
        $data["value"] = $value;
        $data["q"] = $q;
        $data["col"] = ($col) ? $col : (($type == "editor") ? 12 : 6);
        $data["wrap_class"] = $wrap_class;
        $data["tbl"] = $tbl;
        $data["inline"] = $inline;
        $data["name"] = $name;
        $data["num"] = $num;
        $data["allow"] = $allow;
        $data["trans"] = $trans;
        $data["option"] = $option;
        $data["title"] = $title;
        $data["placeholder"] = $placeholder;
        $data["class"] = $class;
        $data["disc"] = $disc;
        $data["view"] = $view;
        $data["type"] = $type;
        $data["check"] = $check;
        $data["content"] = $_content;
//        $data["data"] = $_data;
        if (RC_uri(2) == "index"):
            return $data;
        endif;

        if ($trans == true):
            $q = DB::table("rc_language")->get();
            foreach ($q as $r):
                $_data = "";
                $_data .= " type='" . $type . "' ";
                $_data .= " style='" . $style . "' ";
                $_data .= " placeholder='" . $placeholder . "' ";
                $_data .= " {$attr} ";
                $pos = strpos($name, "[");
                if ($pos == false):
                    $_name = $name . "_{$r->shortcut}";

                    $_data .= " name='" . $_name . "' ";
                else:
                    $ARR_name = explode("[", $name);
                    $_name = $ARR_name[0] . "_{$r->shortcut}[" . $ARR_name[1];
                    $_data .= " name='" . $_name . "' ";
                endif;
                $data["data"] = $_data;
                $data["_name"] = $_name;
                $data["lng"] = $r->shortcut;
                if ($r->active == 0):
                    $data["wrap_class"] = "d-none form_lang_group form_lang_{$r->shortcut} {$wrap_class}";
                else:
                    $data["wrap_class"] = " form_lang_group form_lang_{$r->shortcut} {$wrap_class}";
                endif;
                $data["error"] = self::validation($_name, $check, @$ArrData["input_view"]["type"], $title);
                if ($show == false):
                    $out[] = $data;
                else:
                    $content .= view($view, $data);
                endif;
            endforeach;

        else:

            $_data = "";
            $_data .= " type='" . $type . "' ";
            $_data .= " style='" . $style . "' ";
            $_data .= " placeholder='" . $placeholder . "' ";
            $_data .= " {$attr} ";
            $_data .= " name='" . $name . "' ";
            $data["error"] = self::validation($name, $check, @$ArrData["input_view"]["type"], $title);
            $data["data"] = $_data;
            $data["lng"] = "";
            $data["_name"] = $name;
            if ($show == false):
                $out[] = $data;
            else:
                $content = view($view, $data);
            endif;
        endif;

        if ($hide == false):
            if ($show == false):
                return $out;
            else:
                return $content;
            endif;

        endif;
    }

    private static function val($name = "", $value = "") {
        $submit = request()->post("submit");
        if ($submit) {
            $value = request()->post($name);
        }
        return $value;
    }

    public static function select_multi($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "select") {
        $features["multi"] = true;
        $out = Form::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

}
