<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Lang;

class RC {

    private static $instance = null;

    private function __construct() {
        $this->name = 'Freddy';
    }

    public static function getInstance() {
        self::$instance = new self;

        self::$instance;
    }

    public function sayHello() {
        print "Hello my name is {$this->name}!<br>";
    }

    public function setName($name) {
        $this->name = $name;
    }

    public static function uri($uri) {
        $uri_1 = request()->segment(1);
        if ($uri_1 == "admin") {
            $uri += 1;
        }
        return request()->segment($uri);
    }

    public static function url($path = "") {
        $uri_1 = request()->segment(1);
        if ($uri_1 == "admin") {
            $path = "/admin/" . $path;
        }
        return secure_url($path);
    }

    public static function post($post) {
        return request()->post($post);
    }

    public static function get($get) {
        return request()->get($get);
    }

    private static function global() {

        $submit = request()->post("submit");
        $request = request()->post();
        $uri_1 = request()->segment(1);
        $uri_2 = request()->segment(2);
        $uri_3 = request()->segment(3);

        $class = $uri_1;
        $fun = $uri_2;
        $view_main = "front/form";
        $temp_lang = "front/";

        // get url view ..
        if ($uri_1 == "admin"):
            $class = $uri_2;
            $fun = $uri_3;
            $view_main = "admin/form";
            $temp_lang = "admin/";
        endif;

        if (empty($fun)):
            $fun = "index";
        endif;

        $data = array();
        $data["submit"] = $submit;
        $data["request"] = $request;
        $data["uri_1"] = $uri_1;
        $data["uri_3"] = $uri_2;
        $data["uri_3"] = $uri_3;
        $data["class"] = $class;
        $data["fun"] = $fun;
        $data["view_main"] = $view_main;
        $data["temp_lang"] = $temp_lang;

        return $data;
    }

    public static function trans($data = "", $key = "ar") {

        $d = @unserialize($data);
        if ($d !== false) {
            $out = $d[$key];
        } else {
            $out = $data;
        }

        return $out;
    }

    public static function trans_set($post = "") {
        $q = DB::table("rc_language")->get();
        $data = array();
        foreach ($q as $r):
            $data[$r->shortcut] = request()->post("{$post}_{$r->shortcut}");
        endforeach;

        $out = serialize($data);
        return $out;
    }

    private static function value($name = "", $value = "") {
        $submit = request()->post("submit");
        if ($submit) {
            $value = request()->post($name);
        }
        return $value;
    }

    public static function validation($name = "", $validation = "") {

        $error = "";
        $submit = request()->post("submit");
        $request = request()->post();

        $validators["$name"] = $validation;
        $validator = Validator::make($request, [$name => $validation]);
        if ($validator->fails() && $submit) {
            $messages = $validator->messages();
            foreach ($messages->get($name) as $message) {
                $error = $message;
            }
        }

        return $error;
    }

    private static function input($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        $global = RC::global();

        if (!@$features["inline"]) {
            $inline = false;
        }
        if (!@$features["form"] && @$features["form"] !== false) {
            @$features["form"] = true;
        }


        $data = array();
        $data["col"] = $col;
        $data["inline"] = $inline;
        $data["features"] = $features;
        $data["validation"] = $validation;
        $data["trans"] = $trans;
        $data["tbl"] = $tbl;
        $data["view_url"] = "{$global["view_main"]}/{$block}";
        return $data;
    }

    public static function text($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = true, $block = "textbox") {
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function checkbox($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = true, $block = "checkbox") {
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function email($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {

        if (!@$features["type"]):
            $features["type"] = "email";
        endif;

        if ($validation):
            $validation = $validation . "|email";
        else:
            $validation = "email";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function mobile($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        if (!@$features["type"]):
            $features["type"] = "tel";
        endif;

        if ($validation):
            $validation = $validation . "|numeric";
        else:
            $validation = "numeric";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function num($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        if (!@$features["type"]):
            $features["type"] = "number";
        endif;

        if ($validation):
            $validation = $validation . "|numeric";
        else:
            $validation = "numeric";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function input_url($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        if (!@$features["type"]):
            $features["type"] = "url";
        endif;

        if ($validation):
            $validation = $validation . "|url";
        else:
            $validation = "url";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function date($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {

        $features["class"] = " hijri-date-input " . @$features["class"];

        if ($validation):
            $validation = $validation . "|date";
        else:
            $validation = "date";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function time($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        if (!@$features["type"]):
            $features["type"] = "time";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function datetime($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        if (!@$features["type"]):
            $features["type"] = "datetime-local";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function color($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        if (!@$features["type"]):
            $features["type"] = "color";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function password($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "textbox") {
        if (!@$features["type"]):
            $features["type"] = "password";
        endif;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function hidden($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "hidden") {
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function textarea($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = true, $block = "textarea") {
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function editor($tbl = 0, $validation = "", $features = array(), $col = 12, $trans = true, $block = "editor") {
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function select($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "select") {
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function select_multi($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "select") {
        $features["multi"] = true;
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function image($tbl = 0, $validation = "", $features = array(), $col = 3, $trans = false, $block = "upload") {
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function image_multi($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "upload") {
        if (!@$features["num"]) {
            $features["num"] = 10;
        }
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function file($tbl = 0, $validation = "", $features = array(), $col = 3, $trans = false, $block = "upload") {
        if (!@$features["allow"]) {
            $features["allow"] = ".pdf,.txt,.zip,.rar,.doc,.docx,.xlsx,.xls";
        }
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function file_multi($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "upload") {
        if (!@$features["allow"]) {
            $features["allow"] = ".pdf,.txt,.zip,.rar,.doc,.docx,.xlsx,.xls";
        }
        if (!@$features["num"]) {
            $features["num"] = 10;
        }
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function video($tbl = 0, $validation = "", $features = array(), $col = 3, $trans = false, $block = "upload") {
        if (!@$features["allow"]) {
            $features["allow"] = ".mp4";
        }
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function video_multi($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "upload") {
        if (!@$features["allow"]) {
            $features["allow"] = ".mp4";
        }
        if (!@$features["num"]) {
            $features["num"] = 10;
        }
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function sound($tbl = 0, $validation = "", $features = array(), $col = 3, $trans = false, $block = "upload") {
        if (!@$features["allow"]) {
            $features["allow"] = ".mp3";
        }
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function sound_multi($tbl = 0, $validation = "", $features = array(), $col = 6, $trans = false, $block = "upload") {
        if (!@$features["allow"]) {
            $features["allow"] = ".mp3";
        }
        if (!@$features["num"]) {
            $features["num"] = 10;
        }
        $out = RC::input($tbl, $validation, $features, $col, $trans, $block);
        return $out;
    }

    public static function form_creat($inputs = array(), $trans = false) {
        $global = RC::global();
        $validators = array();
        $languages = "";
        $content = "";
        $error = "";
        $input_name = array();
        $_db = "";

        foreach ($inputs as $name => $input):
            if (@$input["features"]["form"] == true):

                $input_name[] = $name;

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

                $data = array();
                $data = $input;
//            $data["error"] = $error;
                $data["title"] = $title;
                $data["placeholder"] = $placeholder;

                if ($trans == false || $input["trans"] == false) {
                    $validators["$name"] = @$input["validation"];
                    $data["name"] = $name;
                    $data["error"] = RC::validation($name, @$input["validation"]);
                    if (request()->post("submit")):
                        $data["value"] = RC::value($name, @$input["features"]["value"]);
                    else:
                        if ($_db == "update" && isset($r)):
                            $data["value"] = $r->$name;
                        else:
                            $data["value"] = RC::value($name, @$input["features"]["value"]);
                        endif;
                    endif;

                    $content .= view($input["view_url"], $data);
                } else {

                    $languages = DB::table("rc_language")->get();
                    foreach ($languages as $language):
                        $_name = $name . "_" . $language->shortcut;
                        $validators["$_name"] = @$input["validation"];
                        $data["error"] = RC::validation($_name, @$input["validation"]);
                        if (request()->post("submit")):
                            $data["value"] = RC::value($_name, @$input["features"]["value"]);
                        else:
                            if ($_db == "update" && isset($r)):
                                $data["value"] = RC::trans($r->$name, $language->shortcut);
                            else:
                                $data["value"] = RC::value($name, @$input["features"]["value"]);
                            endif;
                        endif;

                        $data["name"] = $_name;
                        if ($language->active == 0):
                            $data["features"]["wrap_class"] = " d-none" . @$input["features"]["wrap_class"];
                        endif;
                        $data["features"]["wrap_class"] = @$data["features"]["wrap_class"] . " form_lang_group  form_lang_{$language->shortcut}";
                        $content .= view($input["view_url"], $data);
                    endforeach;
                }
            endif;
        endforeach;

        return $content;
    }

    public static function form($inputs = array(), $trans = false, $db = array(), $fun = "", $features = array(), $view = "form") {

        $global = RC::global();
        $validators = array();
        $languages = "";
        $content = "";
        $error = "";
        $input_name = array();

        $_db = @$db["db"];

        if (empty($_db)) {
            $_db = self::uri(3);
        }
        if (empty($_db)) {
            $_db = "insert";
        }

        $feature = "";
        if (!empty($db) && array_key_exists("table", $db)) {
            $table = @$db["table"];
        } else {
            $table_name = self::table_name();
            $table = $table_name->table;
            $feature = $table_name->feature;
        }

        if ($_db == "update") {
            if (!@$db["where"]):
                $where = array("id" => self::uri(4));
            else:
                $where = @$db["where"];
            endif;

            $r = DB::table($table);
            $r = self::db_where($r, $where);
            $r = $r->first();
        }

        foreach ($inputs as $name => $input):
            if (@$input["features"]["form"] == true):

                $input_name[] = $name;

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
                    $data["error"] = RC::validation($name, @$input["validation"]);
                    if (request()->post("submit")):
                        $data["value"] = RC::value($name, @$input["features"]["value"]);
                    else:
                        if ($_db == "update" && isset($r)):
                            $data["value"] = $r->$name;
                        else:
                            $data["value"] = RC::value($name, @$input["features"]["value"]);
                        endif;
                    endif;

                    $content .= view($input["view_url"], $data);
                } else {

                    $languages = DB::table("rc_language")->get();
                    foreach ($languages as $language):
                        $_name = $name . "_" . $language->shortcut;
                        $validators["$_name"] = @$input["validation"];
                        $data["error"] = RC::validation($_name, @$input["validation"]);
                        if (request()->post("submit")):
                            $data["value"] = RC::value($_name, @$input["features"]["value"]);
                        else:
                            if ($_db == "update" && isset($r)):
                                $data["value"] = RC::trans($r->$name, $language->shortcut);
                            else:
                                $data["value"] = RC::value($name, @$input["features"]["value"]);
                            endif;
                        endif;

                        $data["name"] = $_name;
                        if ($language->active == 0):
                            $data["features"]["wrap_class"] = " d-none" . @$input["features"]["wrap_class"];
                        endif;
                        $data["features"]["wrap_class"] = @$data["features"]["wrap_class"] . " form_lang_group  form_lang_{$language->shortcut}";
                        $content .= view($input["view_url"], $data);
                    endforeach;
                }
            endif;
        endforeach;

        $validator = Validator::make($global["request"], $validators);
        if ($global["submit"] && !$validator->fails()) {


            $value = array();
            foreach ($input_name as $item):
                if ($trans == true) {
                    $trans = @$inputs[$item]["trans"];
                    if ($trans == true) {
                        $value[$item] = RC::trans_set($item);
                    }
                } else {
                    $value[$item] = request()->post($item);
                }

            endforeach;
            if ($table == "tb_feature"):
                $value["feature"] = $feature;
            endif;
            if ($_db == "insert"):
                if (Schema::hasColumn($table, "date_insert")) {
                    $value["date_insert"] = self::date_time();
                }

                $last_id = DB::table($table)->insertGetId($value);
            endif;

            if ($_db == "update"):
                $db_update = DB::table($table);
                $db_update = RC::db_where($db_update, $where);
                $db_update->update($value);
                $last_id = self::uri(4);
            endif;

            $query_url = "";
            foreach (request()->query() as $k => $v):
                if ($query_url) {
                    $query_url .= "&{$k}={$v}";
                } else {
                    $query_url .= "?{$k}={$v}";
                }
            endforeach;

            if ($fun):
                $fun($last_id);
            endif;

            $redirect = @$features["redirect"];
            if (empty($redirect)) {
                $redirect = ($query_url) ? self::url(self::uri(1)) . $query_url . "&success=true" : self::url(self::uri(1)) . "?success=true";
            }

            header('Location: ' . $redirect . "");
        }
        if ($global["submit"] && $validator->fails()):
            $error = 1;
        endif;

        $action = @$features["action"];
        if (!$action):
            $action = url()->full();
        endif;

        $title_form = @$features["titlle"];
        if (empty($title_form)) {
            $title_form_lang = "{$global["temp_lang"]}{$global["class"]}.{$global["fun"]}_title";
            $title_form = Lang::get($title_form_lang);
            if ($title_form == $title_form_lang) {
                $title_form = "";
            }
        }

        if (empty($title_form)) {
            $url_arr = array();
            $url_arr[] = RC::uri(1);
            $url_arr[] = RC::uri(2);
            $url_arr[] = RC::uri(3);
            if ($_db == "insert") {
                $url_arr[] = RC::uri(4);
                $url_arr[] = RC::uri(5);
                $url_arr[] = RC::uri(6);
            }
            $url_form = implode("/", array_filter($url_arr));
            $Rmenu = DB::table("rc_menu")->where("url", "REGEXP", $url_form)->first();
            if ($Rmenu) {
                $title_form = $Rmenu->title;
            }
        }

        if (empty($title_form)) {
            if ($_db == "insert") {
                $title_form = "اضافة جديد";
            }
            if ($_db == "update") {
                $title_form = "تعديل";
            }
        }


        $data = array();
        $data["content"] = $content;
        $data["languages"] = $languages;
        $data["error"] = $error;
        $data["action"] = $action;
        $data["title"] = $title_form;
        $data["button"] = @$features["button"];
        $out = view($global["view_main"] . "/$view", $data);

        if ($global["submit"] && !$validator->fails()) {
            if ($_db != "insert" && $_db != "update") {
                return array("out" => $out, "error" => false);
            }
        }

        return $out;
    }

    public static function tbl_inject($tbl = 1, $content = "", $features = array()) {

        $features["form"] = false;

        $data = array();
        $data["features"] = $features;
        $data["content"] = $content;
        $data["tbl"] = $tbl;
        return $data;
    }

    private static function table_name() {

        $table = "";
        $feature = "";
        $global = RC::global();

        if (Schema::hasTable("rc_{$global["class"]}")) {
            $table = "rc_{$global["class"]}";
        }
        if (Schema::hasTable("tb_{$global["class"]}")) {
            $table = "tb_{$global["class"]}";
        }

        if ($table == "" || $table == "tb_feature"):
            $feature = DB::table('tb_feature_type')->where('name', $global["class"])->first();
            if ($feature) {
                $table = "tb_feature";
                $feature = $feature->id;
            }
        endif;

        $arr = array();
        $arr["table"] = $table;
        $arr["feature"] = $feature;

        $out = (object) $arr;
        return $out;
    }

    public static function tbl($inputs = array(), $where = array(), $table = "", $limit = 50, $order_by = "id,DESC", $features = array(), $view = "tbl") {
        $global = RC::global();

        if (empty($limit) || $limit == null || $limit == false):
            $limit = 50;
        endif;

        if (empty($order_by || $order_by == null || $order_by == false)) {
            $order_by = "Desc";
        }

        if ($table == "" || $table == false || $table == null):
            if (Schema::hasTable("rc_{$global["class"]}")) {
                $table = "rc_{$global["class"]}";
            }
            if (Schema::hasTable("tb_{$global["class"]}")) {
                $table = "tb_{$global["class"]}";
            }

            if ($table == "" || $table == "tb_feature"):
                $feature = DB::table('tb_feature_type')->where('name', $global["class"])->first();
                if ($feature) {
                    $table = "tb_feature";
                    $where["feature"] = $feature->id;
                }
            endif;
        endif;

        $search = request()->get("search");
        if ($search == true || $search == 1) {
            foreach (request()->query() as $k => $v):
                $column = explode("|", $k);
                if (Schema::hasColumn($table, @$column[0])) {
                    $where[$k] = $v;
                }
            endforeach;
        }

        // tite table ..
        $title_lang = "{$global["temp_lang"]}{$global["class"]}.{$global["fun"]}_title";
        $title_tbl = Lang::get($title_lang);
        if ($title_lang == $title_tbl):
            $title_tbl = "";
        endif;
        // end title table ..


        $q = DB::table($table);
        $q = RC::db_where($q, $where);
        if ($order_by) {
            $order_by = explode(",", $order_by);
            if (count($order_by) > 1) {
                $q->orderBy(@$order_by[0], @$order_by[1]);
            } else {
                $q->orderBy('id', $order_by[0]);
            }
        }
        $q = $q->paginate($limit);

        $search_arr = array();
        $tbl_rows = array();
        foreach ($inputs as $name => $input):
            if ($input["tbl"] > 0 || is_array($input["tbl"])) {
                $input["name"] = $name;

                $title_input = "بحث";
                if (@$input["title"]) {
                    $title_input = $input["title"];
                } else {
                    $title_lang_input = "{$global["temp_lang"]}{$global["class"]}.form_{$name}_title";
                    if (\Lang::has($title_lang_input)) {
                        $title_input = Lang::get($title_lang_input);
                    }
                }


                if (is_array($input["tbl"])):
                    $search_arr[$name] = array("title" => $title_input);
                endif;

                if (is_array(@$input["tbl"])) {
                    $key = $input["tbl"][0];
                } else {
                    $key = $input["tbl"];
                }


                if (array_key_exists($key, $tbl_rows)) {
                    $tbl_rows[count($tbl_rows) + 1] = $input;
                } else {
                    $tbl_rows[$key] = $input;
                }
            }
        endforeach;
        ksort($tbl_rows);

        $thead = array();
        foreach ($tbl_rows as $input):
            $name = @$input["name"];
            $title_lang = "{$global["temp_lang"]}{$global["class"]}.form_{$name}_title";
            $title = Lang::get($title_lang);
            if ($title_lang == $title):
                $title = "";
            endif;
            $thead[] = array("text" => $title, "features" => @$input["features"]["tbl"]);
        endforeach;

        $row = array();
        foreach ($q as $r):
            $col = array();
            foreach ($tbl_rows as $input):
                if (@$input["content"]) {
                    $col[] = array("id" => $r->id, "text" => @$input["content"]($r), "features" => @$input["features"]["tbl"]);
                } else {
                    $name = @$input["name"];
                    if (@$input["trans"] == true) {
                        $col[] = array("id" => $r->id, "text" => self::trans($r->$name), "features" => @$input["features"]["tbl"]);
                    } else {
                        $col[] = array("id" => $r->id, "text" => $r->$name, "features" => @$input["features"]["tbl"]);
                    }
                }
            endforeach;
            $row[] = $col;
        endforeach;

        $data = array();
        $data["title"] = $title_tbl;
        $data["thead"] = $thead;
        $data["rows"] = $row;
        $data["pagination"] = $q;
        $data["search"] = $search_arr;
        $data["features"] = $features;
        $out = view($global["view_main"] . "/$view", $data);

        if (request()->get("ajax") == 1) {
            echo $out;
            die;
        }
        return $out;
    }

    public static function block($content = "", $title = "", $title_left = "", $view = "block") {
        $global = RC::global();
        if (empty($title) || $title == null || $title == false) {
            $title_lang = "{$global["temp_lang"]}{$global["class"]}.{$global["fun"]}_title";
            $title = Lang::get($title_lang);
            if ($title_lang == $title):
                $title = "";
            endif;

            if (empty($title)) {
                $url_arr = array();
                $url_arr[] = RC::uri(1);
                $url_arr[] = RC::uri(2);
                $url_arr[] = RC::uri(3);

                $url_form = implode("/", array_filter($url_arr));
                $Rmenu = DB::table("rc_menu")->where("url", $url_form)->where("parent", ">", 0)->first();
                if ($Rmenu) {
                    $title = $Rmenu->title;
                }
            }
        }

        $data = array();
        $data["content"] = $content;
        $data["title"] = $title;
        $data["title_left"] = $title_left;
        $out = view($global["view_main"] . "/$view", $data);
        return $out;
    }

    public static function date_current() {
        return date("Y-m-d");
    }

    public static function time_current() {
        return date("H:i:s");
    }

    public static function date_time() {
        return date('Y-m-d H:i:s');
    }

    public static function date_string($time) {
        $time = strtotime($time);
        $time = time() - $time; // to get the time since that moment
        $time = ($time < 1) ? 1 : $time;
        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
        }
    }

    public static function div($content = "", $class = "", $attr = array()) {
        $attribute = "";
        foreach ($attr as $k => $v):
            $attribute = " $k='" . $v . "' ";
        endforeach;
        return "<div class='{$class}' {$attribute} >{$content}</div>";
    }

    public static function span($content = "", $class = "", $attr = array()) {
        $attribute = "";
        foreach ($attr as $k => $v):
            $attribute = " $k='" . $v . "' ";
        endforeach;
        return "<span class='{$class}' {$attribute} >{$content}</span>";
    }

    public static function link($title = "", $url = "javascript:void(0)", $class = "btn btn-primary", $attr = array()) {
        $attribute = "";
        foreach ($attr as $k => $v):
            $attribute = " $k='" . $v . "' ";
        endforeach;

        if (!$class) {
            $class = "btn btn-primary";
        }
        if ($class == "false" || $class == "null") {
            $class = "";
        }

        return "<a href='$url' class='{$class}' {$attribute} >{$title}</a>";
    }

    public static function button($title = "", $class = "", $attr = array()) {

        if (@!$attr["name"]) {
            $attr["name"] = "submit";
        }

        if (@!$attr["type"]) {
            $attr["type"] = "submit";
        }

        if (!$class) {
            $class = "btn btn-primary";
        }
        if ($class == "false" || $class == "null") {
            $class = "";
        }

        $attribute = "";
        foreach ($attr as $k => $v):
            $attribute = " $k='" . $v . "' ";
        endforeach;

        return "<button class='{$class}' {$attribute} >{$title}</button>";
    }

    public static function feature($where) {

        $R = DB::table("tb_feature");
        if (is_array($where)) {
            $R = RC::db_where($R, $where);
        }
        if (!is_array($where) && $where) {
            $R = $R->where("id", $where);
        }
        $R = $R->first();

        $columns = Schema::getColumnListing('tb_feature');
        $data = array();
        foreach ($columns as $column):
            $data[$column] = RC::trans($R->$column);
        endforeach;

        $object = (object) $data;
        return $object;
    }

    public static function table($data = array(), $attr = array()) {

        if (@!$attr["class"]) {
            $attr["class"] = "table table-striped table-bordered";
        }

        $attribute = "";
        foreach ($attr as $k => $v):
            $attribute = " $k='" . $v . "' ";
        endforeach;

        $out = "<table {$attribute} >";
        foreach ($data as $k => $rows):
            if (is_int($k)) {
                $k = "";
            }
            $out .= "<tr class='$k'>";
            foreach ($rows as $k => $col):

                if (is_int($k)) {
                    $k = "";
                }

                $out .= "<td class='$k'>";
                $out .= $col;
                $out .= "</td>";
            endforeach;
            $out .= "</tr>";
        endforeach;
        $out .= "</table>";

        return $out;
    }

    public static function db_where($q, $where) {
        $arr = array("in", "notin");
        if ($where) {
            foreach ($where as $k => $v):
                $_k = explode("|", $k);
                if (@$_k[0] == "OR") {
                    $c = "=";
                    if (@$_k[2]) {
                        $c = @$_k[2];
                    }

                    if (strtolower(@$_k[1]) == "in"):
                        $q->orWhereIn(@$_k[0], $v);
                    endif;

                    if (strtolower(@$_k[1]) == "notin"):
                        $q->orWhereNotIn(@$_k[0], $v);
                    endif;
                    if (!in_array(strtolower(@$_k[1]), $arr)):
                        $q = $q->orWhere(@$_k[1], $c, $v);
                    endif;
                } else {
                    $c = "=";
                    if (@$_k[1]) {
                        $c = @$_k[1];
                    }


                    if (strtolower(@$_k[1]) == "in"):
                        $q->whereIn(@$_k[0], $v);
                    endif;

                    if (strtolower(@$_k[1]) == "notin"):
                        $q->whereIn(@$_k[0], $v);
                    endif;

                    if (!in_array(strtolower(@$_k[1]), $arr)):
                        $q = $q->where(@$_k[0], $c, $v);
                    endif;
                }

            endforeach;
        }

        return $q;
    }

    public static function db_delete($where = array(), $table = "", $files = "image") {
        $global = RC::global();

        $id_post = request()->post("id");
        $id_get = request()->get("id");
        if (empty($where)):
            if ($id_post):
                if (is_array($id_post)):
                    $where["id|IN"] = $id_post;
                else:
                    $where["id|IN"] = explode(",", $id_post);
                endif;
            endif;

            if ($id_get):
                $where["id|IN"] = explode(",", $id_get);
            endif;
        endif;

        if ($table == "" || $table == false || $table == null):
            if (Schema::hasTable("rc_{$global["class"]}")) {
                $table = "rc_{$global["class"]}";
            }
            if (Schema::hasTable("tb_{$global["class"]}")) {
                $table = "tb_{$global["class"]}";
            }

            if ($table == "" || $table == false || $table == null):
                $table = "tb_feature";
            endif;
        endif;

        $db = DB::table($table);
        $db = RC::db_where($db, $where);
        $db->delete();
    }

    public static function access() {

//        $user = session('user');
           $user = @$_COOKIE["user"];
        $r = DB::table("rc_users")->where("id", $user)->first();
        if (empty($r)) {
            header('Location: ' . RC::url("rc-admin/logging"));
            exit;
        }
    }

    public static function user($id = "me") {

        if ($id == "me") {
//            $id = session("user");
               $id = @$_COOKIE["user"];
        }

        $data = array();
        $R = DB::table("rc_users")->where("id", $id)->first();
        if ($R):
            $columns = Schema::getColumnListing('rc_users');
            foreach ($columns as $column):
                $data[$column] = RC::trans($R->$column);
            endforeach;
        endif;

        $object = (object) $data;
        return $object;
    }

    public static function redirect($redirect = "", $out = false) {
        if ($out == false) {
            $redirect = RC::url($redirect);
        }
        header('Location: ' . $redirect . "");
        exit;
    }

}
