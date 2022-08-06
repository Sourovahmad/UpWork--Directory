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

class Form {

    public static $currentValue;
    private static $instance = null;

    private function __construct() {
        
    }

    public static function creat($db = "") {

        if ((RC_uri(3) == "insert" || RC_uri(3) == "update") && empty($db) && $db != false && $db != null):
            $db = RC_uri(3);
        endif;

        if ((RC_uri(2) == "insert" || RC_uri(2) == "update") && empty($db) && $db != false && $db != null):
            $db = RC_uri(3);
        endif;

        if (empty($db) && $db != false && $db != null):
            $db = "insert";
        endif;

        self::$instance = new self;
//        self::$currentValue["inputs"] = $inputs;
        self::$currentValue["db_type"] = $db;
        return self::$instance;
    }

    public static function test() {
        $ArrData = self::$currentValue;
        return @$ArrData["db_type"] . "ds";
    }

    public function inject($content = "") {
        self::$instance = new self;
        self::$currentValue["inputs"][] = $content;
    }

    public function action($data) {
        self::$currentValue["action"] = $data;
        return $this;
    }

    public function fun($data) {
        self::$currentValue["fun"] = $data;
        return $this;
    }

    public function redirect($data) {
        self::$currentValue["redirect"] = $data;
        return $this;
    }

    public function button($button = true, $button_title = "") {
        self::$currentValue["button_title"] = $button_title;
        self::$currentValue["button"] = $button;
        return $this;
    }

    public function db($where = "", $table = "tb_feature", $value = array()) {
        self::$currentValue["db"] = array("where" => $where, "table" => $table, "value" => $value);
        return $this;
    }

    private static function validation($arr) {



        $error = "";
        $submit = request()->post("submit");
        $request = request()->post();

        foreach ($arr as $item):
            $name = $item["name"];
            $validation = $item["validation"];
            $type = $item["type"];

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

            $validators["$name"] = $validation;

        endforeach;

        $validator = Validator::make($request, $validators);
        if ($submit) {
            if ($validator->fails()) {
                $messages = $validator->messages();
                foreach ($messages->get($name) as $message) {
                    $error = $message;
                }
                // echo "errro";
                session()->flash('success', false);
            } else {
                //echo "success";
                session()->flash('success', true);
            }
        }
        return $error;
    }

    public static function get($view = null) {

        $ArrData = self::$currentValue;
        $inputs = @$ArrData["inputs"];
        $fun = @$ArrData["fun"];
        $button = (@$ArrData["button"]) ? @$ArrData["button"] : true;
        $button_title = @$ArrData["button_title"];
        $redirect = @$ArrData["redirect"];
        $db = @$ArrData["db_type"];
        $db_arr = @$ArrData["db"];
        $where = @$ArrData["db"]["where"];
        $table = (@$ArrData["db"]["table"]) ? @$ArrData["db"]["table"] : "tb_feature";
        $val = @$ArrData["db"]["value"];
        $action = (@$ArrData["action"]) ? @$ArrData["action"] : url()->full();
        $view = ($view && $view != null) ? $view = $view : RC_urlForm("form");
        $trans = false;

        $page_class = RC_uri(1);
        if (Schema::hasTable("rc_{$page_class}")) {
            $table = "rc_{$page_class}";
        }
        if (Schema::hasTable("tb_{$page_class}")) {
            $table = "tb_{$page_class}";
        }
        if (empty($table)):
            $table = "tb_feature";
        endif;

        if (!$where || empty($where)):
            $where = ["id" => RC_uri(4)];
        endif;

        if (empty($db)):
            $db = RC_uri(3);
        endif;

        $arr = array();
        $content = "";

        if ($db == "update"):
            $R_data = DB::table($table);
            $R_data = RC_dbWhere($R_data, $where);
            $R_data = $R_data->first();
        endif;

        $content = "";
        foreach ($inputs as $input):
            if (is_array($input)):
                $content .= implode("", $input);
            else:
                $content .= $input;
            endif;
        endforeach;

        $feature = "";

        if ($db == "update"):
            $R_data = DB::table($table);
            $R_data = RC_dbWhere($R_data, $where);
            $R_data = $R_data->first();
        endif;
        if ($db == "insert" && $table == "tb_feature"):
            $r_feature = DB::table("tb_feature_type")->where("name", RC_uri(1))->first();
            if ($r_feature):
                $feature = $r_feature->id;
            endif;
        endif;

        if (session()->get('success') == true && request()->post("submit")) {
            $last_id = 0;
            /*
              if ($db == "insert" || $db == "update"):
              $value = array();
              $posts = request()->post();
              foreach ($posts as $n => $val):
              $post = @RC_trans_set($n);
              if (Schema::hasColumn($table, $post->name)) {
              if ($post->name == "password"):
              $value[$post->name] = sha1($post->val);
              else:
              //                            if ($post->val):
              if (is_array($post->val)):
              $_val = implode(",", $post->val);
              else:
              $_val = $post->val;
              endif;
              $value[$post->name] = $_val;
              //                            endif;
              endif;
              }
              endforeach;
              endif;

              if ($db == "insert"):
              if ($table == "tb_feature"):
              $value["feature"] = $feature;
              endif;
              if (Schema::hasColumn($table, "date_insert")) {
              $value["date_insert"] = RC_dateTime();
              }
              $last_id = DB::table($table)->insertGetId($value);
              if ($fun):
              $fun($last_id);
              endif;
              endif;
             */

            if ($db == "insert"):
                $last_id = db_insert($table);
            endif;

            if ($fun):
                $fun($last_id);
            endif;

            if ($db == "update"):

                /*
                  $db_update = DB::table($table);
                  $db_update = RC_dbWhere($db_update, $where);
                  $db_update->update($value);
                  $last_id = RC_uri(4);
                 * 
                 */

                $last_id = db_update($where , $table);
                if ($fun):
                    $fun($last_id);
                endif;
            endif;

            if ($db != "insert" && $db != "update" && $fun) {
                $fun();
            }
            if ($redirect) {
                if ($redirect != null && $redirect != false && $redirect != "stop") {
                    RC_redirect($redirect);
                }
            } else {
                if (request()->segment(1) == "rc-admin" && request()->segment(2) == "settings"):
                    RC_redirect("settings/" . RC_uri(1));
                else:
                    RC_redirect(RC_uri(1));
                endif;
            }
        }

        $languages = DB::table("rc_language")->get();

        $data = array();
        $data["languages"] = $languages;
        $data["content"] = $content;
        $data["action"] = $action;
        $data["button"] = $button;
        $data["trans"] = $trans;
        $data["button_title"] = $button_title;
        return view($view, $data);
    }

    public static function data() {
        $ArrData = self::$currentValue;
        $db = (@$ArrData["db_type"]) ? @$ArrData["db_type"] : RC_uri(3);
        $where = @$ArrData["db"]["where"];
        $table = (@$ArrData["db"]["table"]) ? @$ArrData["db"]["table"] : "";

        $page_class = RC_uri(1);
        if (Schema::hasTable("rc_{$page_class}")) {
            $table = "rc_{$page_class}";
        }
        if (Schema::hasTable("tb_{$page_class}")) {
            $table = "tb_{$page_class}";
        }
        if (empty($table)):
            $table = "tb_feature";
        endif;

        if (!$where || empty($where)):
            $where = ["id" => RC_uri(4)];
        endif;

        $R_data = "";
        if ($db == "update"):
            $R_data = DB::table($table);
            $R_data = RC_dbWhere($R_data, $where);
            $R_data = $R_data->first();
        endif;

        $arr = array("db" => $db, "row" => $R_data);
        $obj = (object) $arr;
        return $obj;
    }

    public static function get_($view = null) {
        $ArrData = self::$currentValue;
        $inputs = @$ArrData["inputs"];
        $fun = @$ArrData["fun"];
        $button = (@$ArrData["button"]) ? @$ArrData["button"] : true;
        $button_title = @$ArrData["button_title"];
        $redirect = @$ArrData["redirect"];
        $db = @$ArrData["db_type"];
        $db_arr = @$ArrData["db"];
        $where = @$ArrData["db"]["where"];
        $table = (@$ArrData["db"]["table"]) ? @$ArrData["db"]["table"] : "";
        $val = @$ArrData["db"]["value"];
        $action = (@$ArrData["action"]) ? @$ArrData["action"] : url()->full();
        $view = ($view && $view != null) ? $view = $view : RC_urlForm("form");
        $trans = false;

        if (!$where || empty($where)):
            $where = ["id" => RC_uri(4)];
        endif;

        if (empty($db)):
            $db = RC_uri(3);
        endif;

        $arr = array();
        $content = "";
        if ($db == "update"):
            $R_data = DB::table($table);
            $R_data = RC_dbWhere($R_data, $where);
            $R_data = $R_data->first();
        endif;
        foreach ($inputs as $input):
            if (is_array($input)):
                foreach ($input as $my_input):
                    $arr[] = array("name" => @$my_input["_name"], "validation" => @$my_input["check"], "type" => @$my_input["type"], "value" => @$my_input["value"]);
                    $name = @$my_input["name"];
                    $_name = @$my_input["_name"];
                    $data = array();
                    $data = $my_input;

                    if ($data["trans"] == true) {
                        $trans = true;
                    }

                    if (request()->post("submit")):
                        $data["value"] = request()->post($_name);
                    else:
                        if (@$my_input["value"] && $data["trans"] = true):
                            $data["value"] = RC_trans(@$my_input["value"], @$my_input["lng"]);
                        endif;
                        if (isset($R_data) && Schema::hasColumn($table, $name)):
                            $data["value"] = RC_trans($R_data->$name, @$my_input["lng"]);
                        endif;
                    endif;
                    $content .= view($my_input["view"], $data);
                endforeach;
            endif;
        endforeach;

        self::validation($arr);

        $feature = "";

        if ($db == "update"):
            $R_data = DB::table($table);
            $R_data = RC_dbWhere($R_data, $where);
            $R_data = $R_data->first();
        endif;
        if ($db == "insert" && $table == "tb_feature"):
            $r_feature = DB::table("tb_feature_type")->where("name", RC_uri(1))->first();
            if ($r_feature):
                $feature = $r_feature->id;
            endif;
        endif;

        if (session()->get('success') == true && request()->post("submit")) {

            if ($db == "insert" || $db == "update"):
                $value = array();

                $posts = request()->post();
                foreach ($posts as $n => $val):
                    $post = RC_trans_set($n);
                    if (Schema::hasColumn($table, $post->name)) {
                        if ($post->name == "password"):
                            $value[$post->name] = sha1($post->val);
                        else:
                            $value[$post->name] = $post->val;
                        endif;
                    }
                endforeach;
            endif;

            if ($db == "insert"):
                if ($table == "tb_feature"):
                    $value["feature"] = $feature;
                endif;
                if (Schema::hasColumn($table, "date_insert")) {
                    $value["date_insert"] = RC_dateTime();
                }
                $last_id = DB::table($table)->insertGetId($value);
                if ($fun):
                    $fun($last_id);
                endif;
            endif;

            if ($db == "update"):
                $db_update = DB::table($table);
                $db_update = RC_dbWhere($db_update, $where);
                $db_update->update($value);
                $last_id = RC_uri(4);
                if ($fun):
                    $fun($last_id);
                endif;
            endif;

            if ($db != "insert" && $db != "update" && $fun) {
                $fun();
            }
            if ($redirect) {
                if ($redirect != null && $redirect != false && $redirect != "stop") {
                    RC_redirect($redirect);
                }
            } else {
                if (request()->segment(1) == "rc-admin" && request()->segment(2) == "settings"):
                    RC_redirect("settings/" . RC_uri(1));
                else:
                    RC_redirect(RC_uri(1));
                endif;
            }
        }

        $languages = DB::table("rc_language")->get();

        $data = array();
        $data["languages"] = $languages;
        $data["content"] = $content;
        $data["action"] = $action;
        $data["button"] = $button;
        $data["trans"] = $trans;
        $data["button_title"] = $button_title;
        return view($view, $data);
    }

    public static function form_($inputs = array(), $trans = false) {

        $global = Form::global();
        $validators = array();
        $languages = "";
        $content = "";
        $error = "";

        foreach ($inputs as $name => $input):

            $title_lang = "{$global["temp_lang"]}{$global["class"]}.{$global["fun"]}_{$name}_title";
            $placeholder_lang = "{$global["temp_lang"]}{$global["class"]}.{$global["fun"]}_{$name}_placeholder";

            $title = Lang::get($title_lang);
            $placeholder = Lang::get($placeholder_lang);

            // title .. 
            if (@$input["features"]["title"]) {
                $title = @$input["features"]["title"];
            }
            if ($title == $title_lang) {
                $title = null;
            }

            //placeholder
            if (@$input["features"]["placeholder"]) {
                $placeholder = @$input["features"]["placeholder"];
            }
            if ($placeholder == $placeholder_lang) {
                $placeholder = $title;
            }
            /*
              // validation ..

              $validator = Validator::make(@$global["request"], [$name => @$input["validation"]]);
              if ($validator->fails() && @$global["submit"]) {
              $messages = $validator->messages();
              foreach ($messages->get($name) as $message) {
              $error = $message;
              }
              }


              // value
              $value = @$input["features"]["value"];
              if (@$global["submit"]) {
              $value = request()->post($name);
              }
             * 
             */

            $data = array();
            $data = $input;
//            $data["error"] = $error;

            $data["title"] = $title;
            $data["placeholder"] = $placeholder;

            if ($trans == false || $input["trans"] == false) {
                $validators["$name"] = @$input["validation"];
                $data["name"] = $name;
                $data["error"] = Form::validation($name, @$input["validation"]);
                $data["value"] = Form::value($name, @$input["features"]["value"]);
                $content .= view($input["view_url"], $data);
            } else {

                $languages = DB::table("rc_language")->get();
                foreach ($languages as $language):
                    $name = $name . "_" . $language->shortcut;
                    $validators["$name"] = @$input["validation"];
                    $data["error"] = Form::validation($name, @$input["validation"]);
                    $data["value"] = Form::value($name, @$input["features"]["value"]);
                    $data["name"] = $name;
                    if ($language->active == 0):
                        $data["features"]["wrap_class"] = " d-none" . @$input["features"]["wrap_class"];
                    endif;
                    $data["features"]["wrap_class"] = @$data["features"]["wrap_class"] . " form_lang_group  form_lang_{$language->shortcut}";
                    $content .= view($input["view_url"], $data);
                endforeach;
            }

        endforeach;

        $validator = Validator::make($global["request"], $validators);
        if ($global["submit"] && !$validator->fails()) {
//            echo "asdsd";
            die;
        }
        if ($global["submit"] && $validator->fails()):
            $error = 1;
        endif;

        $data = array();
        $data["content"] = $content;
        $data["languages"] = $languages;
        $data["error"] = $error;
        $out = view($global["view_main"] . "/block", $data);
        return $out;
    }

}
