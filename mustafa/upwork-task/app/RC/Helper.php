<?php

define("RC_IN_TEXT", array("type" => "text", "view" => "textbox", "disc" => "", "trans" => true, "check" => "", "class" => ""));
define("RC_IN_CHECKBOOX", array("type" => "checkbox", "view" => "checkbox", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_email", array("type" => "email", "view" => "textbox", "disc" => "", "trans" => false, "check" => "email", "class" => ""));
define("RC_IN_mobile", array("type" => "tel", "view" => "textbox", "disc" => "", "trans" => false, "check" => "numeric", "class" => ""));
define("RC_IN_num", array("type" => "number", "view" => "textbox", "disc" => "", "trans" => false, "check" => "numeric", "class" => ""));
define("RC_IN_URL", array("type" => "url", "view" => "textbox", "disc" => "", "trans" => false, "check" => "url", "class" => ""));
define("RC_IN_date", array("type" => "date", "view" => "textbox", "disc" => "", "trans" => false, "check" => "date", "class" => " hijri-date-input "));
define("RC_IN_time", array("type" => "time", "view" => "textbox", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_datetime", array("type" => "datetime-local", "view" => "textbox", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_color", array("type" => "color", "view" => "textbox", "disc" => "", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_password", array("type" => "password", "view" => "textbox", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_hidden", array("type" => "hidden", "view" => "hidden", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_TEXTAREA", array("type" => "textarea", "view" => "textarea", "disc" => "", "trans" => true, "check" => "", "class" => ""));
define("RC_IN_select", array("type" => "select", "view" => "select", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_SELECT", array("type" => "select", "view" => "select", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_selectMulti", array("type" => "select_multi", "view" => "select", "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_EDITOR", array("type" => "editor", "view" => "editor", "disc" => "", "trans" => true, "check" => "", "class" => ""));
define("RC_IN_CONTENT", array("type" => "content", "view" => "input_content", "disc" => "content", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_MAP", array("type" => "hidden", "view" => "map", "disc" => "map", "trans" => false, "check" => "", "class" => ""));

// images and file cofig
define("RC_IN_IMAGE", array("type" => "hidden", "view" => "upload", "allow" => ".jpg,.jpeg,.png,.gif", "num" => 1, "disc" => "image", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_imageMulti", array("type" => "hidden", "view" => "upload", "allow" => ".jpg,.jpeg,.png,.gif", "num" => 10, "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_file", array("type" => "hidden", "view" => "upload", "allow" => ".pdf,.txt,.zip,.rar,.doc,.docx,.xlsx,.xls", "num" => 1, "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_fileMulti", array("type" => "hidden", "view" => "upload", "allow" => ".pdf,.txt,.zip,.rar,.doc,.docx,.xlsx,.xls", "num" => 10, "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_video", array("type" => "hidden", "view" => "upload", "allow" => ".mp4", "num" => 1, "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_videoMulti", array("type" => "hidden", "view" => "upload", "allow" => ".mp4", "num" => 10, "disc" => "", "trans" => false, "check" => "", "class" => ""));
define("RC_IN_sound", array("type" => "hidden", "view" => "upload", "allow" => ".mp3", "num" => 1, "trans" => false, "check" => "", "class" => ""));
define("RC_IN_soundMulti", array("type" => "hidden", "view" => "upload", "allow" => ".mp3", "num" => 10, "disc" => "", "trans" => false, "check" => "", "class" => ""));

function RC_urlView($url = "") {
    $uri_1 = request()->segment(1);
    if ($uri_1 == "rc-admin"):
        $url = "admin/$url";
    else:
        $url = "front/$url";
    endif;
    return $url;
}

function RC_urlForm($url = "") {
    return RC_urlView("form/$url");
}

function RC_urlLayout($url = "") {
    return RC_urlView("layout/$url");
}

function RC_temp($temp = true) {
    $uri_1 = request()->segment(1);
    if ($uri_1 == "rc-admin") {
        $temp = "admin";
    } else {
        if ($temp == true):
            $temp = "front";
        endif;
    }
    return $temp;
}

function url_view($url = "") {
    $uri_1 = request()->segment(1);
    if ($uri_1 == "rc-admin") {
        $url = "admin/$url";
    } else {
        $url = "front/$url";
    }

    return $url;
}

function url_layout($url = "") {
    return url_view("layout/$url");
}

function url_common($url = "") {
    return url_view("common/$url");
}

function url_image($name = "", $url = "front/img") {
    return secure_url("$url/$name");
}

function url_image_auto($name = "", $url = "/img") {
    return secure_url(RC_temp() . "$url/$name");
}

function url_image_admin($name = "", $url = "admin/img") {
    return secure_url("$url/$name");
}

function RC_uri($uri) {
    $uri_1 = request()->segment(1);
    $uri_2 = request()->segment(2);

    if ($uri_1 == "rc-admin") {
        If ($uri_2 == "settings") {
            $_uri = $uri + 2;
        } else {
            $_uri = $uri + 1;
        }
    } else {
        $_uri = $uri;
    }

    $out = request()->segment($_uri);
    if (empty($out)):
        if ($uri == 1) {
            $out = "home";
        }
        if ($uri == 2) {
            $out = "index";
        }
    endif;
    return $out;
}

function uri($uri) {
    return RC_uri($uri);
}

function RC_url($path = "") {
    $uri_1 = request()->segment(1);
    if ($uri_1 == "rc-admin") {
        $path = "/rc-admin/" . $path;
    }
    return secure_url($path);
}

function base_url($path = "") {
    return secure_url($path);
}

function admin_url($path = "") {
    return secure_url("rc-admin/" . $path);
}

function RC_post($post) {
    return request()->post($post);
}

function RC_get($get) {
    return request()->get($get);
}

function RC_lang($text = "", $auto = true) {
    if ($auto == true):
        $uri_1 = request()->segment(1);
        $uri_2 = request()->segment(2);
        if ($uri_1 == "rc-admin"):
            if ($uri_2 == "settings") {
                $text = RC_temp() . "/settings/" . RC_uri(1) . "." . $text;
            } else {
                $text = RC_temp() . "/" . RC_uri(1) . "." . $text;
            }
        else:
            $text = RC_temp() . "/" . RC_uri(1) . "." . $text;
        endif;

    endif;
//    echo $text;
//    die;
    $out = "";
    if (Lang::has($text)):
        $out = Lang::get($text);
    endif;
    return $out;
}

function RC_trans($data = "", $key = "ar") {

    $d = @unserialize($data);
    if ($d !== false) {
        $out = @$d[$key];
    } else {
        $out = $data;
    }

    return $out;
}

function RC_trans_set($post = "", $object = true) {
    $q = DB::table("rc_language")->get();

    $lng = array();
    foreach ($q as $Rlng):
        $lng[] = $Rlng->shortcut;
    endforeach;
    $post_arr = explode("_", $post);
    $shortcut = end($post_arr);
    if (in_array($shortcut, $lng)):
        $post = str_replace("_{$shortcut}", "", $post);
        $data = array();
        foreach ($q as $r):
            $data[$r->shortcut] = request()->post("{$post}_{$r->shortcut}");
        endforeach;
        $out = serialize($data);
    else:
        $out = request()->post($post);
    endif;

    if ($object == true) {
        $arr = array("name" => $post, "val" => $out);
        $obj = (object) $arr;
        return $obj;
    }

    return $out;
}

function RC_redirect($redirect = "", $out = false) {
    if ($out == false) {
        $redirect = RC_url($redirect);
    }
    header('Location: ' . $redirect . "");
    exit;
}

function RC_dateCurrent($formate="Y-m-d") {
    return date($formate);
}

function RC_dateTomorrow($formate="Y-m-d") {
    $datetime = new DateTime('tomorrow');
    return $datetime->format($formate);
}

function RC_dateAfterTomorrow($formate="Y-m-d") {
    $datetime = new DateTime('tomorrow + 1day');
    return $datetime->format($formate);
}

function RC_timeCurrent() {
    return date("H:i:s");
}

function RC_dateTime() {
    return date('Y-m-d H:i:s');
}

function RC_date($time) {
    $time = strtotime($time);
    $time = time() - $time; // to get the time since that moment
    $time = ($time < 1) ? 1 : $time;
    $tokens = array(
        31536000 => 'عام',
        2592000 => 'شهر',
        604800 => 'أسبوع',
        86400 => 'يوم',
        3600 => 'ساعة',
        60 => 'دقيقة',
        1 => 'ثانية'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit)
            continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? '' : '');
    }
}

function RC_div($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<div class='{$class}' {$attribute} >{$content}</div>";
}

function div($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<div class='{$class}' {$attribute} >{$content}</div>";
}

function hr($class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<hr class='{$class}' {$attribute} />";
}

function br($class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;

    return "<br class='{$class}' {$attribute} />";
}

function label($content = "", $class = "", $attr = null) {
    if (is_array($attr)) {
        foreach ($attr as $k => $v):
            $attribute = " $k='" . $v . "' ";
        endforeach;
    } else {
        $attribute = $attr;
    }
    return "<label class='{$class}' {$attribute} >{$content}</label>";
}

function input($type = "text", $name = "", $class = "", $attr = null) {
    if (is_array($attr)) {
        foreach ($attr as $k => $v):
            $attribute = " $k='" . $v . "' ";
        endforeach;
    } else {
        $attribute = $attr;
    }
    return "<input type='$type' name='$name' class='{$class}' {$attribute} />";
}

function p($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<p  class='{$class}' {$attribute} >{$content}</p>";
}

function h1($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<h1 class='{$class}' {$attribute} >{$content}</h1>";
}

function h2($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<h2 class='{$class}' {$attribute} >{$content}</h2>";
}

function h3($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<h3 class='{$class}' {$attribute} >{$content}</h3>";
}

function h4($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<h4 class='{$class}' {$attribute} >{$content}</h4>";
}

function h5($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<h5 class='{$class}' {$attribute} >{$content}</h5>";
}

function h6($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<h6 class='{$class}' {$attribute} >{$content}</h6>";
}

function img($src = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<img src='{$src}' class='{$class}' {$attribute} />";
}

function RC_span($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<span class='{$class}' {$attribute} >{$content}</span>";
}

function span($content = "", $class = "", $attr = array()) {
    $attribute = "";
    foreach ($attr as $k => $v):
        $attribute = " $k='" . $v . "' ";
    endforeach;
    return "<span class='{$class}' {$attribute} >{$content}</span>";
}

function RC_link($title = "", $url = "javascript:void(0)", $class = "btn btn-primary", $attr = array()) {
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

function RC_button($title = "", $class = "", $attr = array()) {

    if (@!$attr["disc"]) {
        $attr["disc"] = "submit";
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

function RC_tbl($data = array(), $attr = array()) {

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

function RC_access($permission = true) {

    $uri_1 = request()->segment(1);
    if ($uri_1 == "rc-admin") {
//        $user = session("user");
        $user = @$_COOKIE["user"];
    } else {
//        $user = Session::get('user_id');
        $user = @$_COOKIE["user_id"];
//        $user = session("user_id");
    }

    //  $user = session('user');

    $r = DB::table("rc_users")->where("id", $user)->first();
    if (empty($r)) {

        if ($uri_1 == "rc-admin") {
            header('Location: ' . RC_url("logging"));
            exit;
        } else {

            header('Location: ' . base_url() . "?login=force");
            exit;
        }
    } else {


        if (request()->segment(1) == "rc-admin" && $r->id > 1):

            $uri_1 = uri(1);
            $uri_2 = uri(2);
            $uri_3 = uri(3);
            $uri_4 = uri(4);

            $url = $uri_1;
            if ($uri_2 && $uri_2 != "index") {
                $url .= "/$uri_2";
            }
            if ($uri_3) {
                $url .= "/$uri_3";
            }
//            if ($uri_4) {
//                $url .= "/$uri_4";
//            }

            $r_menu = DB::table("rc_menu")->where("url", $url)->where([["parent", ">", 0]])->first();

            $r_permission = DB::table("rc_usergroup")->where("id", $r->group)->first();
            if ($r_permission && $r_menu) {
                $arr_permission = explode(",", $r_permission->permission);
                if (!in_array($r_menu->id, $arr_permission)) {
                    abort(403);
                }
            }

        endif;

        //abort(403);
    }
}

function RC_dbWhere($q, $where) {



    if ($where && !empty($where)):
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



    endif;

    return $q;
}

function db_where($q, $where) {
    RC_dbWhere($q, $where);
}

function private_db_val($table = "", $value = array(), $_post = true) {
    $out = 0;
    $val = array();
    $sting = array("varchar", "text", "longblob", "longtext", "char");
    $int = array("int", "float");
    $date = array("datetime", "date", "time", "year");

    if (empty($table)) {
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
    }

    if ($table) {
        $columns = db_column($table);

        // val posts ..
        if ($_post == true) {
            $posts = request()->post();
            foreach ($posts as $n => $_val):

                $post = @RC_trans_set($n);
                if (Schema::hasColumn($table, $post->name)) {

                    $k = $post->name;
                    $v = $post->val;

                    // string .
                    if (in_array($columns[$k]["type"], $sting)) {
                        $v = ($v) ? $v : "";
                    }

                    // int
                    if (in_array($columns[$k]["type"], $int) && (!$v || empty($v) || $v == null || $v == "")) {
                        $v = 0;
                    }

                    // date time .
                    if (in_array($columns[$k]["type"], $date) && (!$v || empty($v) || $v = null || $v == "")) {
                        $v = ($columns[$k]["type"] == "date") ? "0000-00-00" : "";
                        $v = ($columns[$k]["type"] == "datetime") ? "0000-00-00 00:00:00" : "";
                        $v = ($columns[$k]["type"] == "time") ? "00:00:00" : "";
                        $v = ($columns[$k]["type"] == "year") ? "0000" : "";
                    }

                    if (is_array($v)):
                        $v = implode(",", $v);
                    endif;

                    if ($k == "password"):
                        $v = sha1($v);
                    endif;

                    $v = str_replace('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', "", $v);

                    if (!array_key_exists($k, $val)) {
                        $val[$k] = $v;
                    }
                }
            endforeach;
        }


        foreach ($value as $k => $v):


            if (array_key_exists($k, $columns)) {

                // string .
                if (in_array($columns[$k]["type"], $sting)) {
                    $v = ($v) ? $v : "";
                }

                // int
                if (in_array($columns[$k]["type"], $int) && (!$v || empty($v) || $v == null || $v == "")) {
                    $v = 0;
                }

                // date time .
                if (in_array($columns[$k]["type"], $date) && (!$v || empty($v) || $v = null || $v == "")) {
                    $v = ($columns[$k]["type"] == "date") ? "0000-00-00" : "";
                    $v = ($columns[$k]["type"] == "datetime") ? "0000-00-00 00:00:00" : "";
                    $v = ($columns[$k]["type"] == "time") ? "00:00:00" : "";
                    $v = ($columns[$k]["type"] == "year") ? "0000" : "";
                }

                if (is_array($v)):
                    $v = implode(",", $v);
                endif;

                $v = str_replace('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', "", $v);

                $val[$k] = $v;
            }

        endforeach;

        if (Schema::hasColumn($table, "date_insert")) {
            $val["date_insert"] = RC_dateTime();
        }

        //   $out = DB::table($table)->insertGetId($val);
    }

    return array("val" => $val, "table" => $table);
}

function db_insert($table = "", $value = array(), $_post = true) {
    $db = private_db_val($table, $value, $_post);
    $val = @$db["val"];

    if (@$db["table"] == "tb_feature" && !array_key_exists("feature", $val)) {
        $r = DB::table("tb_feature_type")->where("name", uri(1))->first();
        if ($r) {
            $val["feature"] = $r->id;
        }
    }

    $table = @$db["table"];
    $out = DB::table($table)->insertGetId($val);
    return $out;
}

function db_update($where = null, $table = "", $value = array(), $_post = true) {

    $db = private_db_val($table, $value, $_post);
    $val = @$db["val"];
    $table = @$db["table"];

    if (!$where || empty($where) || $where == null):
        $where = ["id" => RC_uri(4)];
    endif;

    if (is_int($where) && $where > 0) {
        $where = ["id" => $where];
    }



    $db_update = DB::table($table);
    $db_update = RC_dbWhere($db_update, $where);
    $db_update->update($val);

    $db_get = DB::table($table);
    $db_get = RC_dbWhere($db_get, $where);
    $r = $db_get->first();

    if ($r):
        return $r->id;
    endif;
}

function db_column($table) {
    $database_name = env('DB_DATABASE', 'forge');
    $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database_name' AND TABLE_NAME = '$table';";
//    $column_info = DB::select("describe  $table");
    $q = DB::select($sql);
    $data = array();
    foreach ($q as $r):
        $array = (array) $r;

        $keys = array_keys($array);
        $keys[array_search("COLUMN_NAME", $keys)] = "name";
        $keys[array_search("DATA_TYPE", $keys)] = "type";
        $keys[array_search("COLUMN_COMMENT", $keys)] = "comment";
        $array = array_combine($keys, $array);

        $data[$r->COLUMN_NAME] = $array;
    endforeach;

    return $data;
}

function RC_dbDelete($where = array(), $table = "", $files = "image") {


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
        if (Schema::hasTable("rc_" . RC_uri(1))) {
            $table = "rc_" . RC_uri(1);
        }
        if (Schema::hasTable("tb_" . RC_uri(1))) {
            $table = "tb_" . RC_uri(1);
        }

        if ($table == "" || $table == false || $table == null):
            $table = "tb_feature";
        endif;
    endif;

    $q = DB::table($table);
    $q = RC_dbWhere($q, $where);
    $q = $q->get();
    foreach ($q as $r):
        if (@$r->image) {
            image_delete($r->image);
        }
    endforeach;

    $db = DB::table($table);
    $db = RC_dbWhere($db, $where);
    $db->delete();
}

function RC_feature($where) {

    $R = DB::table("tb_feature");
    if (is_array($where)) {
        $R = RC_dbWhere($R, $where);
    }
    if (!is_array($where) && $where) {
        $R = $R->where("id", $where);
    }
    $R = $R->first();

    $columns = Schema::getColumnListing('tb_feature');
    $data = array();
    foreach ($columns as $column):
        $data[$column] = RC_trans($R->$column);
    endforeach;

    $object = (object) $data;
    return $object;
}

function RC_user($id = "me") {

    if ($id == "me") {
        $uri_1 = request()->segment(1);
        if ($uri_1 == "rc-admin") {
//            $id = session("user");
            $id = @$_COOKIE["user"];
        } else {
            //$id = session("user_id");
//            $id = Session::get('user_id');
            $id = @$_COOKIE["user_id"];
        }
    }

    $R = DB::table("rc_users")->where("id", $id)->first();
    $columns = Schema::getColumnListing('rc_users');
    $data = array();
    foreach ($columns as $column):
        $data[$column] = RC_trans($R->$column);
    endforeach;

    $object = (object) $data;
    return $object;
}

function user($id = "me") {

    if ($id == "me") {
        $uri_1 = request()->segment(1);
        if ($uri_1 == "rc-admin") {
//            $id = session("user");
            $id = @$_COOKIE["user"];
        } else {
            //$id = session("user_id");
//            $id = Session::get('user_id');
            $id = @$_COOKIE["user_id"];
        }
    }



    $R = DB::table("rc_users")->where("id", $id)->first();
    $data = array();
    if ($R):
        $columns = Schema::getColumnListing('rc_users');
        foreach ($columns as $column):
            $data[$column] = RC_trans($R->$column);
        endforeach;
    endif;

    $object = (object) $data;
    if (empty($data)) {
        $object = null;
    }
    return $object;
}

function RC_success() {
    return session()->get('success');
}

function settings($where, $trans = null) {

    $R = DB::table("rc_settings");

    if (!is_array($where) && $where) {
        $R = $R->where("item", $where);
    }
    $R = $R->first();
    if ($trans == null):
        return $R->value;
    else:
        return RC_trans($R->value, $trans);
    endif;
}

function RC_settings_set() {

    $posts = request()->post();
//    print_r($posts);
    foreach ($posts as $name => $post):
        if ($name != "_token" && $name != "submit") {

            /*
              $value = array();
              $value["value"] = RC_trans_set($name)->val;
              db_update($where, "rc_settings", $value, false);
             * 
             */

            $arr = explode("_", $name);
            $ext = end($arr);

            $lang = array();
            $q = DB::table("rc_language")->get();
            foreach ($q as $r):
                $lang[] = $r->shortcut;
            endforeach;

            if (in_array($ext, $lang)):
                $_name = str_replace("_{$ext}", "", $name);
            else:
                $_name = $name;
            endif;

            $where = array("item" => $_name);
            $value = array();
            $value["value"] = RC_trans_set($name)->val;
            db_update($where, "rc_settings", $value, false);
//            $db_update = DB::table("rc_settings");
//            $db_update = RC_dbWhere($db_update, $where);
//            $db_update->update($value);
        }

    endforeach;
    return "";
}

function RC_form($content, $action = null, $view = null) {

////    if ($action == null):
    $action = url()->full();
////    endif;
//
    if ($view == null):
        $view = RC_urlForm("form_basic");
    endif;
//
    $data = array();
    $data["content"] = $content;
    $data["action"] = $action;
    return view($view, $data);
}

function rc_language() {
    $where = array("view", 1);
    $R = DB::table("rc_language");
    $R = RC_dbWhere($R, $where);
    $R = $R->get();
    return $R;
}

function RC_map($location, $attr = null, $view = null) {


    if ($view == null):
        $view = RC_urlForm("map_view");
    endif;

    $data = array();
    $data["class"] = @$attr["class"];
    $data["width"] = @$attr["width"];
    $data["height"] = @$attr["height"];
    $data["location"] = $location;
    return view($view, $data);
}

function image_micro($image = "", $default = null) {
    $path = "files/micro/";

    $i = "";
    $img_url = "";
    $ARR_img = explode(",", $image);
    if ($ARR_img) {
        $i = public_path() . "/$path" . $ARR_img[0];
        $img_url = secure_url("$path" . $ARR_img[0]);
    }

    if (!$image || !file_exists($i)) {
        if ($default) {
            $img_url = url_image_auto("$default");
        } else {
            $img_url = url_image_auto("default.jpg");
        }
    }
    return $img_url;
}

function image_min($image = "", $default = null) {
    $path = "files/thumbs/";

    $i = "";
    $img_url = "";
    $ARR_img = explode(",", $image);
    if ($ARR_img) {
        $i = public_path() . "/$path" . $ARR_img[0];
        $img_url = secure_url("$path" . $ARR_img[0]);
    }

    if (!$image || !file_exists($i)) {
        if ($default) {
            $img_url = url_image_auto("$default");
        } else {
            $img_url = url_image_auto("default.jpg");
        }
    }
    return $img_url;
}

function image_larg($image = "", $default = null) {
    $path = "files/larg/";

    $i = "";
    $img_url = "";
    $ARR_img = explode(",", $image);
    if ($ARR_img) {
        $i = public_path() . "/$path" . $ARR_img[0];
        $img_url = secure_url("$path" . $ARR_img[0]);
    }

    if (!$image || !file_exists($i)) {
        if ($default) {
            $img_url = url_image_auto("$default");
        } else {
            $img_url = url_image_auto("default.jpg");
        }
    }
    return $img_url;
}

function image_origin($image = "", $default = null) {
    $path = "files/";

    $i = "";
    $img_url = "";
    $ARR_img = explode(",", $image);
    if ($ARR_img) {
        $i = public_path() . "/$path" . $ARR_img[0];
        $img_url = secure_url("$path" . $ARR_img[0]);
    }

    if (!$image || !file_exists($i)) {
        if ($default) {
            $img_url = url_image_auto("$default");
        } else {
            $img_url = url_image_auto("default.jpg");
        }
    }
    return $img_url;
}

function file_delete($file = "") {

    $ARR_img = explode(",", $file);
    foreach ($ARR_img as $img):
        $name = $img;
        File::delete("public/files/$name");
        File::delete("public/files/thumbs/$name");
        File::delete("public/files/micro/$name");
        File::delete("public/files/larg/$name");
        DB::table('rc_upload')->where('name', '=', $name)->delete();
    endforeach;

    return 1;
}

function image_delete($image = "") {
    file_delete($image);
    return 1;
}

function rc_email($to, $subject = "", $message = "", $tmp = "email_tmp", $from = "") {

    $api_email = settings("api_email");
    if (empty($from)):
        $from = "info@" . request()->getHost();
    endif;

    $data = array();
    if ($tmp != null):
        $data["content"] = $message;
        $message = view(url_common($tmp), $data);
    endif;

    $curl = @curl_init();
    @curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    @curl_setopt($curl, CURLOPT_POST, 1);
    @curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json"
    ));
    @curl_setopt($curl, CURLOPT_URL, "https://api.smtp2go.com/v3/email/send"
    );
    @curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
                "api_key" => "{$api_email}",
                "to" => array(
                    0 => "<$to>"
                ),
                "sender" => "<$from>",
                "subject" => "$subject",
                "text_body" => "$message",
                "html_body" => "$message",
                "custom_headers" => array(
                    0 => array(
                        "header" => "Reply-To",
                        "value" => "Actual Person <test3@example.com>"
                    )
                )
    )));
    $result = @curl_exec($curl);

//    return $result;
}

function km($from, $to, $earthRadius = 6371000) {
    // convert from degrees to radians

    $ARR_from = explode(",", $from);
    $latitudeFrom = @$ARR_from[0];
    $longitudeFrom = @$ARR_from[1];

    $ARR_to = explode(",", $to);
    $latitudeTo = $ARR_to[0];
    $longitudeTo = $ARR_to[1];

    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    
    $km = ($angle * $earthRadius) / 1000;
    return round($km, 2);
}
