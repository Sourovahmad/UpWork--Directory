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
use Illuminate\Support\Facades\Session;

class Logging extends Controller {

    public $table;

    public function __construct() {
        $this->table = "rc_users";
    }

    private function data() {
        $inputs = array();
        $index = array();

        // name ..
        $input = Input::creat(RC_IN_TEXT, "username", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // mobile ..
        $input = Input::creat(RC_IN_mobile, "mobile", false);
        $input = $input->check(4, null, "unique:rc_users,mobile")->col(12);
        $inputs[] = $input->get();

        // email ..
        $input = Input::creat(RC_IN_email, "email", false);
        $input = $input->check(4, 255, "unique:rc_users,email")->col(12);
        $inputs[] = $input->get();

        //  password ..
        $input = Input::creat(RC_IN_password, "password", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        //  repassword ..
        $input = Input::creat(RC_IN_password, "repassword", false);
//        $input = $input->check(1 , 255 , "unique:password")->col(12);
        $input = $input->check(1, 255, "same:password")->col(12);
        $inputs[] = $input->get();

        //  code ..
        $code = rand(10000, 100000);
        $input = Input::creat(RC_IN_hidden, "code", false);
        $input = $input->value($code);
        $inputs[] = $input->get();

        $inputs[] = view(RC_urlView("view/register/button"));

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {

        function success() {

            $username = request()->post("username");
            $code = request()->post("code");
            $email = request()->post("email");

            $message = h1("تفعيل حسابك");
            $message .= p(" مرحبا ، {$username} ");
            $message .= p("تم تسجيل عضويتك بنجاح يتبقى لك خطوة لإستخدام حساب و هي تفعيل حسابك ");
            $message .= p("رابط تفعيل حسابك هو : ");
            $message .= p(RC_link(base_url("logging/activation/$code"), base_url("logging/activation/$code")));
            rc_email($email, "تفعيل حسابك", $message);
        }

        $form = Form::creat("insert")->db("", "rc_users")->fun(success()); // from creat
        $form->inject($this->data()->form);
        $out = $form->redirect(base_url("register?save=true"))->get();

        $container = view(RC_urlView("view/register/container"), ["content" => $out]);

        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function login() {

        $username = "";
        $username_mobile = "";
        $success = 0;
        $msg = div("خطأ في البريد الإلكتروني او كلمة المرور .", "alert alert-danger");

        $email = request()->post("email");
        $password = sha1(request()->post("password"));

        $r = DB::table($this->table)->where("email", $email)->where("password", $password)->first();
        if ($r) {
//            if ($r->active == 1) {
            $success = 1;
            $msg = "";
            //session(['user_id' => $r->id]);
            // Session::put('user_id', $r->id);
            setcookie("user_id", $r->id, time() + (8640000 * 3000), "/"); // 86400 = 1 day
            $username = "<a class='text-white' href='". base_url("account")."'>{$r->username}</a>";
            $username_mobile = '<a class="text-white  fs-4 me-4 d-inline-block" href="'.base_url("account").'"><i class="far fa-user"></i></a>';

            // redirect(base_url());
//            } else {
//                $success = 0;
//                $msg = div("حسابك غير مفعل رجاء الرجوع الي البريد الإلكتروني الخاص بك بتفعيل حسابك من خلال الرساله المرسله لك .", "alert alert-danger");
//            }
        } else {
            $success = 0;
        }

        $data = array();
        $data["success"] = $success;
        $data["username"] = $username;
        $data["username_mobile"] = $username_mobile;
        $data["error"] = $msg;
        echo json_encode($data);
    }

    public function losspass() {

        $error = "";
        $success = "";

        $email = request()->post("email");

        $r = DB::table($this->table)->where("email", $email)->first();
        if ($email && $r) {

            $password = rand(10000, 1000000);

            $values = array();
            $values["password"] = sha1($password);
            DB::table($this->table)->where("email", $email)->update($values);

            $message = h1("إستعادة كلمة المرور");
            $message .= p(" مرحبا ، {$r->username} ");
            $message .= p("تم تعديل كلمة المرور الخاص بكم بناء علي طلبكم ");
            $message .= p("كلمة المرور الجديدة هي");
            $message .= p($password);
            rc_email($email, "طلب إستعاده كلمة المرور", $message);
            $success = div("تم إرسال كلمة المرور الجديدة لكم علي البريد الإلكتروني الخاص بكم .", "alert alert-success");
        } else {
            $error = div("البريد الإلكتروني المدخل غير مدرج لدينا رجاء التاكد من البريد الإلكتروني المدخل .", "alert alert-danger");
        }

        $data = array();
        $data["success"] = $success;
        $data["error"] = $error;
        echo json_encode($data);
    }

    public function activation() {

        $code = uri(3);

        $values = array();
        $values["active"] = 1;
        DB::table($this->table)->where("code", $code)->update($values);

        $container = view(RC_urlView("view/logging/activation"));
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function logout() {
        request()->session()->forget('user_id');
        if (isset($_COOKIE['user_id'])) {
            unset($_COOKIE['user_id']);
            setcookie('user_id', '', time() - 3600, '/'); // empty value and old timestamp
        }
        return redirect(RC_url());
    }

}
