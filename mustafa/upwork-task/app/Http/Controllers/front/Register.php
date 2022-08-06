<?php

namespace App\Http\Controllers\front;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\RC;
use App\RC\Form;
use App\RC\Input;
use App\RC\Tbl;
use App\RC\Block;
use Lang;

class Register extends Controller {

    private function data() {

        // config ..
        $type = request()->get("type");
        $inputs = array();
        $index = array();

        // name ..
        $input = Input::creat(RC_IN_TEXT, "username", false);
        $input = $input->title(RC_lang("username_title_$type"));
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // section ..
        if ($type == 2):
            $input = Input::creat(RC_IN_select, "section", false)->title(null, RC_lang("section_placeholder"));
            $input->db(["feature" => 11]);
            $input = $input->check(1, 255)->col(12);
            $inputs[] = $input->get();

            $input = Input::creat(RC_IN_select, "gender", false)->title(null, RC_lang("gender_placeholder"));
            $input->option("ذكر", 1);
            $input->option("أنثى", 2);
            $input = $input->check(1, 255)->col(12);
            $inputs[] = $input->get();
        endif;

        // mobile ..
        $input = Input::creat(RC_IN_mobile, "mobile", false);
        $input = $input->check(4, null, "unique:rc_users,mobile")->col(12);
        $inputs[] = $input->get();

        // email ..
        $input = Input::creat(RC_IN_email, "email", false);
        $input = $input->check(4, 255, "unique:rc_users,email")->col(12);
        $inputs[] = $input->get();

        if ($type == 2):

            // c_record ..
            $input = Input::creat(RC_IN_imageMulti, "c_record", false);
            $input = $input->check(0)->col(12);
            $inputs[] = $input->get();

            // image ..
            $input = Input::creat(RC_IN_IMAGE, "image", false);
            $input = $input->check(1)->col(12);
            $inputs[] = $input->get();

            // filles ..
            $input = Input::creat(RC_IN_fileMulti, "files", false);
            $input = $input->check(1)->allow(".jpg,.jpeg,.png,.jpg,.mp4,.mov")->col(12);
            $inputs[] = $input->get();

            // location ..
            $input = Input::creat(RC_IN_MAP, "location", false);
            $input = $input->check(1)->col(12);
            $inputs[] = $input->get();
        endif;

        //  password ..
        $input = Input::creat(RC_IN_password, "password", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        //  repassword ..
        $input = Input::creat(RC_IN_password, "repassword", false);
        $input = $input->check(1, 255, "same:password")->col(12);
        $inputs[] = $input->get();

        //  role ..
        $input = Input::creat(RC_IN_CHECKBOOX, "role", false);
        $input = $input->value(1);
        $input = $input->check(1, 255)->col(12);
        $inputs[] = $input->get();

        //  code ..
        $code = rand(10000, 100000);
        $input = Input::creat(RC_IN_hidden, "code", false);
        $input = $input->value($code);
        $inputs[] = $input->get();

        //  type ..
        $input = Input::creat(RC_IN_hidden, "type", false);
        $input = $input->value($type);
        $inputs[] = $input->get();

        $inputs[] = view(RC_urlView("view/register/button"));

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {


        $type = request()->get("type");
        $title = "تسجيل عضوية عميل جديدة";
        if ($type == 2) {
            $title = "تسجيل عضوية مقدم خدمة جديدة";
        }

        if (!in_array($type, array(1, 2))) {
            abort(404);
        }




        $form = Form::creat("insert")->db("", "rc_users")->fun(function () {

            $username = request()->post("username");
            $code = request()->post("code");
            $email = request()->post("email");
            $type = request()->post("type");

            $r = DB::table("rc_users")->where("code", $code)->first();
            if ($r) {
                setcookie("user_id", $r->id, time() + (8640000 * 3000), "/");
                $values = array();
                $values["user"] = $r->id;
                if ($type == 1):
                    $values["content"] = "لم يتم التحقق من البريد الإلكتروني ، رجاء الرجوع الي البريد الإلكتروني لتفعيل حسابك .";
                else:
                    $values["content"] = "حسابك غير مفعل ، جاري مراجعته من قبل الإدارة";
                endif;
                $values["owner"] = 0;
                $values["view"] = 0;
                $values["date_insert"] = RC_dateCurrent();
                DB::table("tb_notification")->insert($values);

                redirect(base_url());
            }

            if ($type == 1):
                $message = h1("تفعيل حسابك");
                $message .= p(" مرحبا ، {$username} ");
                $message .= p("تم تسجيل عضويتك بنجاح يتبقى لك خطوة لإستخدام حساب و هي تفعيل حسابك ");
                $message .= p("رابط تفعيل حسابك هو : ");
                $message .= p(RC_link(base_url("logging/activation/$code"), base_url("logging/activation/$code")));
                rc_email($email, "تفعيل حسابك", $message);
            endif;
        }); // from creat
        $form->inject($this->data()->form);

        $out = $form->redirect(base_url("register?save=true&type=$type"))->get();

        $container = view(RC_urlView("view/register/container"), ["content" => $out, "title" => $title]);

        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function ajax() {


        $username_data = "";
        $username_mobile = "";
        $success = 0;
        $username = request()->post("username");
        $code = request()->post("code");
        $email = request()->post("email");
        $type = request()->post("type");
        $mobile = request()->post("mobile");
        $password = request()->post("password");

        $errors = "";
        $errors .= Input::validation("username", "min:3", "", "الإسم");
        $errors .= Input::validation("mobile", "min:3|unique:rc_users", "tel", "الجوال");
        $errors .= Input::validation("email", "min:5|unique:rc_users|email", "", "البريد الإلكتروني");
        $errors .= Input::validation("password", "min:3", "", "كلمة المرور");
        $errors .= Input::validation("repassword", "same:password", "", "تأكيد كلمة المرور");

        if (!empty($errors)) {
            $errors = div($errors, "alert alert-danger");
        }

        if (RC_success() == true) {

            $value = array();
            $value["username"] = $username;
            $value["mobile"] = $mobile;
            $value["email"] = $email;
            $value["type"] = $type;
            $value["code"] = $code;
            $value["password"] = sha1($password);
            $value["date_insert"] = RC_dateTime();
            $id = db_insert("rc_users", $value);

            $r = DB::table("rc_users")->where("id", $id)->first();
            if ($r) {
                $success = 1;
                setcookie("user_id", $r->id, time() + (8640000 * 3000), "/"); // 86400 = 1 day
                $username_data = "<a class='text-white' href='" . base_url("account") . "'>{$r->username}</a>";
                $username_mobile = '<a class="text-white  fs-4 me-4 d-inline-block" href="' . base_url("account") . '"><i class="far fa-user"></i></a>';
            } else {
                $success = 0;
            }

            $message = h1("تفعيل حسابك");
            $message .= p(" مرحبا ، {$username} ");
            $message .= p("تم تسجيل عضويتك بنجاح يتبقى لك خطوة لإستخدام حساب و هي تفعيل حسابك ");
            $message .= p("رابط تفعيل حسابك هو : ");
            $message .= p(RC_link(base_url("logging/activation/$code"), base_url("logging/activation/$code")));
            rc_email($email, "تفعيل حسابك", $message);
        }

        echo json_encode(array("error" => $errors, "success" => $success, "username" => $username_data, "username_mobile" => $username_mobile));
    }

}
