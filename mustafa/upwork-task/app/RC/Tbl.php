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

class Tbl {

    public static $currentValue;
    private static $instance = null;

    private function __construct() {
        
    }

    public static function creat($inputs = array(), $checkbox = true, $auto = true) {
        self::$instance = new self;
        self::$currentValue["inputs"] = $inputs;
        self::$currentValue["auto"] = $auto;
        self::$currentValue["checkbox"] = $checkbox;
        return self::$instance;
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
        self::$currentValue["class"] = $data;
        return $this;
    }

    public function wrap_class($class = "") {
        self::$currentValue["wrap_class"] = $class;
        return $this;
    }

    public function db($where = array(), $table = "") {
        self::$currentValue["where"] = $where;
        self::$currentValue["table"] = $table;
        return $this;
    }

    public function limit($limit = 50) {
        self::$currentValue["limit"] = $limit;
        return $this;
    }

    public function order_by($column = "id", $order = "DESC") {
        self::$currentValue["order_by_column"] = $column;
        self::$currentValue["order_by"] = $order;
        return $this;
    }

//    public static function get($inputs = array(), $where = array(), $table = "", $limit = 50, $order_by = "id,DESC", $features = array(), $view = "tbl") {

    public static function get($view = "tbl") {

        $features = array();
        $order_by = "id,DESC";

        $page_class = RC_uri(1);
        $ArrData = self::$currentValue;
        $inputs = @$ArrData["inputs"];
        $class = @$ArrData["class"];
        $attr = @$ArrData["attr"];
        $style = @$ArrData["style"];
        $wrap_class = @$ArrData["wrap_class"];
        $checkbox = @$ArrData["checkbox"];
        $where = @$ArrData["where"];
        $table = @$ArrData["table"];
        $limit = (@$ArrData["limit"]) ? @$ArrData["limit"] : 50;
        $order_by = (@$ArrData["order_by"]) ? @$ArrData["order_by"] : "DESC";
        $order_by_column = (@$ArrData["order_by_column"]) ? @$ArrData["order_by_column"] : "id";

        $_data = "";
        $_data .= " $attr ";
        $_data .= " style='{$style}' ";

        //     $global = self::global();

        if ($table == "" || $table == false || $table == null):


            if (Schema::hasTable("rc_{$page_class}")) {
                $table = "rc_{$page_class}";
            }
            if (Schema::hasTable("tb_{$page_class}")) {
                $table = "tb_{$page_class}";
            }

            if ($table == "" || $table == "tb_feature"):
                $R_feature = DB::table('tb_feature_type')->where('name', $page_class)->first();
                if ($R_feature) {
                    $table = "tb_feature";
                    $where["feature"] = $R_feature->id;
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



        $q = DB::table($table);
        $q = RC_dbWhere($q, $where);
        $q->orderBy($order_by_column, $order_by);
        $q = $q->paginate($limit);

        $search_arr = array();
        $tbl_rows = array();

        foreach ($inputs as $input):
            $name = $input["name"];
            if ($input["tbl"] > 0 || is_array($input["tbl"])) {

                $title_input = "بحث";
                if (@$input["title"]) {
                    $title_input = $input["title"];
                } else {
//                    $title_lang_input = "{$global["temp_lang"]}{$global["class"]}.{$input["name"]}_title";
                    $title_input = $input["title"];
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
            $thead[] = array("text" => $input["title"], "features" => @$input["features"]["tbl"]);
        endforeach;

        $row = array();
        foreach ($q as $r):
            $col = array();
            foreach ($tbl_rows as $input):

                if (@$input["disc"] == "content") {
//                    $col[] = array("id" => $r->id, "text" => @$input["content"]($r), "features" => @$input["features"]["tbl"]);
                    $col[] = array("id" => $r->id, "text" => @$input["value"]($r), "features" => @$input["features"]["tbl"]);
                } else {

                    $name = @$input["name"];
                    if ($input["type"] == "select" && @$input["db"]) {

                        $R_select_val = DB::table(@$input["db"])->where(@$input["key"], $r->$name)->first();
                        if ($R_select_val):
                            $column = @$input["column"];
                            $col[] = array("id" => $r->id, "text" => RC_trans( $R_select_val->$column) , "features" => @$input["features"]["tbl"]);
                        else:
                            $col[] = array("id" => $r->id, "text" => " ", "features" => @$input["features"]["tbl"]);
                        endif;
                    } else {

                        if ($input["disc"] == "image") {
                            $col[] = array("id" => $r->id, "text" => img(image_micro($r->$name), "", ["style" => "max-height:100px;max-width:100px;"]), "features" => @$input["features"]["tbl"]);
                        } else {

                            if (@$input["trans"] == true) {
                                $col[] = array("id" => $r->id, "text" => RC_trans($r->$name), "features" => @$input["features"]["tbl"]);
                            } else {
                                $col[] = array("id" => $r->id, "text" => $r->$name, "features" => @$input["features"]["tbl"]);
                            }
                        }
                    }
                }
            endforeach;
            $row[] = $col;
        endforeach;

        $data = array();
        $data["thead"] = $thead;
        $data["rows"] = $row;
        $data["pagination"] = $q;
        $data["search"] = $search_arr;
        $data["features"] = $features;

        $data["class"] = $class;
        $data["wrap_class"] = $wrap_class;
        $data["checkbox"] = $checkbox;
        $data["data"] = $_data;
        $out = view(RC_urlForm($view), $data);

        if (request()->get("ajax") == 1) {
            echo $out;
            die;
        }
        return $out;
    }

}
