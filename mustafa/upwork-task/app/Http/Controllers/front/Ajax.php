<?php

namespace App\Http\Controllers\front;

use App\RC;
use App\RC\Form;
use App\RC\Input;
use App\RC\Tbl;
use App\RC\Block;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use App\Http\Middleware\VerifyCsrfToken;

class Ajax extends Controller {

    public function index() {
        
    }

    public function select_ajax() {

        // relation ..
        $relation = request()->post("relation");
        $relation = ($relation) ? $relation : "parent";

        // table..
        $table = request()->post("table");
        $table = ($table) ? $table : "tb_feature";

        // column ..
        $column = request()->post("column");
        $column = ($column) ? $column : "title";

        // val ..
        $val = request()->post("val");
        $val = ($val) ? $val : "id";

        $id = request()->post("id");

        $q = DB::select("SELECT * from $table WHERE $relation =  $id");

//        $q = DB::table($table)->where($relation, $id)->get();

        $option = "<option value=''>حدد المطلوب ..</option>";
        foreach ($q as $r):
            $title = RC_trans($r->$column);
            $option .= "<option value='{$r->$val}'>{$title}</option>";
        endforeach;

        echo json_encode(array("option" => $option));
    }

    public function select_service() {

        $id = request()->post("id");

               $__date  = date("Y-m-d");
        
//        $q = DB::table("tb_feature")->where("feature", 15)->where("section", $id)->where([["title", ">=", date("d-m-Y")]])->get();
        $q = DB::table("tb_feature")->where("feature", 15)->where("section", $id)->where(DB::raw('str_to_date(title, "%d-%m-%Y")'),'>=',"$__date" )->get();

//        $q = DB::table($table)->where($relation, $id)->get();
        if (count($q) > 0):
            $option = "<option value=''>حدد المطلوب ..</option>";
        else:
            $option = "<option value=''>لا توجد مواعيد متاحة .</option>";
        endif;

        foreach ($q as $r):


            $title = RC_trans($r->title);
            if ($title == RC_dateCurrent("d-m-Y")) {
                $title = "اليوم";
            }
            if ($title == RC_dateTomorrow("d-m-Y")) {
                $title = "غدا";
            }
            if ($title == RC_dateAfterTomorrow("d-m-Y")) {
                $title = "بعد غد";
            }

            //$title = RC_trans($r->title);   
            $option .= "<option value='{$r->id}'>{$title}</option>";
        endforeach;

        echo json_encode(array("data" => $option));
    }

    public function fav() {


        $id = request()->post("id");
        $success = 0;
        $msg = "";
        $user = user();
        if ($user) {

            $Rfav = DB::table("tb_order")->where("type", 1)->where("post", $id)->where("user", $user->id)->first();
            if ($Rfav) {
                DB::table("tb_order")->where("id", $Rfav->id)->delete();
            } else {
                $value = array();
                $value["type"] = 1;
                $value["post"] = $id;
                $value["user"] = $user->id;
                $value["date_insert"] = RC_dateCurrent();
                DB::table("tb_order")->insert($value);
            }

            $success = 1;
        } else {
            $msg = "يجب تسجيل دخول أولا .";
        }
        echo json_encode(array("success" => $success));
    }

    public function contact() {


        $errors = "";
        $success = "";
        $errors .= Input::validation("name", "min:3", "", "الإسم");
        $errors .= Input::validation("mobile", "min:3", "tel", "الجوال");
        $errors .= Input::validation("content", "min:5", "", "محتوى الرسالة");

        if (!empty($errors)) {
            $errors = div($errors, "alert alert-danger");
        }

        if (RC_success() == true) {
            $value = array();
            $value["name"] = request()->post("name");
            $value["mobile"] = request()->post("mobile");
            $value["content"] = request()->post("content");
            db_insert("tb_contact", $value);

            $success = div("تم إرسال طلبكم بنجاح إلى الإدارة", "alert alert-success");
        }

        echo json_encode(array("error" => $errors, "success" => $success));
    }

    public function rate() {


        // config ..
        $data = array();
        $validators = array();
        $input = array();
        $user = user();
        $success = 1;
        $error = "";
        $msg = "";

        $request = request()->post();

        $validators["content"] = "required";
        $input["content"] = "تفاصيل تقييمك";

        $validator = Validator::make($request, $validators);
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($validators as $k => $v):
                foreach ($messages->get($k) as $message) {
                    $msg .= div(str_replace('$input_title', $input[$k], $message));
                    $success = 0;
                }
            endforeach;
        } else {

            $values = array();
            $values["type"] = 3;
            $values["val"] = request()->post("val");
            $values["post"] = request()->post("post");
            $values["user"] = $user->id;
            $values["content"] = request()->post("content");
            $values["date_insert"] = RC_dateTime();
            DB::table("tb_order")->insert($values);

            $msg = "تم إدراج تقييمك بنجاح";
        }

        echo json_encode(array("data" => $data, "success" => $success, "msg" => $msg));
    }

    public function cart() {

        // config ..
        $data = array();
        $validators = array();
        $input = array();
        $user = user();
        $code = rand(1000, 10000);
        $success = 1;
        $login = 1;
        $error = "";
        $msg = "";

        $request = request()->post();

        $validators["dates"] = "required";
        $input["dates"] = "تاريخ الحجز";

        $validators["time"] = "required";
        $input["time"] = "وقت الحجز";

        $validators["service"] = "required";
        $input["service"] = "الخدمة";

        $validators["name"] = "required";
        $input["name"] = "إسم المريض";

        $validators["mobile"] = "required|numeric";
        $input["mobile"] = "رقم الجوال";

        $validators["content"] = "required";
        $input["content"] = "نبذه عن المريض";

        $validators["gender"] = "required";
        $input["gender"] = "الجنس";

        $validators["age"] = "required";
        $input["age"] = "العمر";

        if ($user == null) {

            //$("#form_login").modal("show");

            $login = 0;
        } else {

            $validator = Validator::make($request, $validators);
            if ($validator->fails()) {
                $messages = $validator->messages();
                foreach ($validators as $k => $v):
                    foreach ($messages->get($k) as $message) {
                        $msg .= div(str_replace('$input_title', $input[$k], $message));
                        $success = 0;
                    }
                endforeach;
            } else {

                $price = 0;
                $commission = 0;
                $owner = 0;
                $Rpost = DB::table("tb_hospital")->where("id", request()->post("post"))->first();
                if ($Rpost) {
                    $_commission = settings("commission");
                    $commission = ($Rpost->price * ($_commission / 100));
                    if (request()->post("type") == 3) {
                        $commission = settings("commission_complement");
                    }


                    $price = $Rpost->price + $commission;

                    $owner = $Rpost->user;
                }

                $values = array();
                $values["user"] = $user->id;
                $values["owner"] = $owner;
                $values["code"] = $code;
                $values["type"] = request()->post("type");
                $values["post"] = request()->post("post");
                $values["date"] = request()->post("dates");
                $values["time"] = request()->post("time");
                $values["service"] = request()->post("service");
                $values["name"] = request()->post("name");
                $values["mobile"] = request()->post("mobile");
                $values["content"] = request()->post("content");
                $values["gender"] = request()->post("gender");
                $values["age"] = request()->post("age");
                $values["insurance"] = request()->post("insurance");
                $values["method"] = request()->post("method");
                $values["price"] = $price;
                $values["commission"] = $commission;
                $values["commission_paid"] = 0;
                $values["view"] = 0;
                $values["status"] = 0;
                $values["date_insert"] = RC_dateTime();
                DB::table("tb_cart")->insert($values);

                $content = "أرسل إليك حجز جديد برقم ($code) ، رجاء الرجوع الي قائمة الحجوزات للإطلاع علي تفاصيل الحجز كاملا .";
                $values = array();
                $values["user"] = $owner;
                $values["owner"] = $user->id;
                $values["content"] = $content;
                $values["view"] = 0;
                $values["date_insert"] = RC_dateCurrent();
                DB::table("tb_notification")->insert($values);

                $content = "  تم حجز موعد  جديد برقم ($code) ، وهو الان قيد المراجعه .";
                $values = array();
                $values["user"] = $user->id;
                $values["owner"] = $owner;
                $values["content"] = $content;
                $values["view"] = 0;
                $values["date_insert"] = RC_dateCurrent();
                DB::table("tb_notification")->insert($values);

                $msg = div("تم الحجز بنجاح و هو قيد المراجعه الان ");
                $success = 1;
            }
        }
        echo json_encode(array("data" => $data, "success" => $success, "msg" => $msg, "login" => $login));
    }

    public function time_booking() {

        $id = request()->post("id");
        $option = "<option value=''>حدد وقت الحجز</option>";

        $R_date = DB::table("tb_feature")->where("id", $id)->first();
        $option = "<option value=''>حدد وقت الحجز</option>";
        if ($R_date):
            $times = explode(",", $R_date->details);
            foreach ($times as $time):
                $_time = date('h:i a', strtotime($time));
                $option .= "<option value='$_time'>$_time</option>";
            endforeach;
        endif;

        echo json_encode(array("data" => $option));
    }

    public function location() {

        $km = 0;
        $to = request()->post("to");
        $location = request()->post("location");

        setcookie("location", $location, time() + (8640000 * 3000), "/"); // 86400 = 1 day
        if ($location) {
            $km = km($location, $to);
        }

        $data = "يبعد عنك {$km} كم";
        echo json_encode(array("data" => $data));
    }

}
