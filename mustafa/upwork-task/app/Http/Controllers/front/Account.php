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

class Account extends Controller {

    public $user;

    function __construct() {
        $this->user = user();
    }

    public function index() {
        RC_access();
        $user = $this->user;

        $block = Block::creat(true, "حسابي"); // block creat

        $view = view(RC_urlView("view/account/index"), ["user" => $user]);
        $block->inject($view);
        $out = $block->get(RC_urlForm("block_lists")); // block end ..


        echo view(RC_urlView("layout/layout"), ["container" => $out]);
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
        $input = $input->check(4, null)->col(12);
        $inputs[] = $input->get();

        // email ..
        $input = Input::creat(RC_IN_email, "email", false);
        $input = $input->check(4, 255)->col(12);
        $inputs[] = $input->get();

        if ($this->user->type == 2) {

            // section ..
            $input = Input::creat(RC_IN_select, "section", false)->title(null, RC_lang("section_placeholder"));
            $input->db(["feature" => 11]);
            $input = $input->check(1, 255)->col(12);
            $inputs[] = $input->get();

            $input = Input::creat(RC_IN_select, "gender", false)->title(null, RC_lang("gender_placeholder"));
            $input->option("ذكر", 1);
            $input->option("أنثى", 2);
            $input = $input->check(1, 255)->col(12);
            $inputs[] = $input->get();

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
        }

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function update() {
        RC_access();
        $user = $this->user;

        $form = Form::creat("update")->db(["id" => $user->id], "rc_users"); // from creat

        $block = Block::creat(true, "تعديل بياناتي")->btn(true, "حفظ التعديلات"); // block creat
        if (request()->get("save") == true):
            $block->inject(div(div("تم حفظ التعديلات بنجاح", "alert alert-success "), "col-md-12"));
        endif;
        $block->inject($this->data()->form);
        $container = $block->get(RC_urlForm("block_form")); // block end ..
        // form end
        $form->inject($container);
        $out = $form->redirect(base_url("account/update?save=true"))->get();

        echo view(RC_urlView("layout/layout"), ["container" => $out]);
    }

    private function password_data() {

        $inputs = array();
        $index = array();

        //  current_password ..
        $input = Input::creat(RC_IN_password, "current_password", false);
        $input = $input->check(4, 255)->col(12);
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

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function password() {
        RC_access();
        $user = user();

        $form = Form::creat("false"); // from creat
        //$form->db(["id" => $user->id], "rc_users"); 

        $block = Block::creat(true, "تعديل كلمة المرور")->btn(true, "حفظ كلمة المرور الجديدة"); // block creat
        if (request()->get("success") == true):
            $block->inject(div(div("تم حفظ كلمة المرور الجديدة بنجاح", "alert alert-success "), "col-md-12"));
        endif;
        if (request()->get("error") == true):
            $block->inject(div(div("كلمة المرور الحالية المدخلة غير صحيحة", "alert alert-danger "), "col-md-12"));
        endif;
        $block->inject($this->password_data()->form);
        $container = $block->get(RC_urlForm("block_form")); // block end ..
        // form end
        $form->inject($container);
        $form->fun(function () {
            $user = user();
            $Rcheck = DB::table("rc_users")->where("id", $user->id)->where("password", sha1(request()->post("current_password")))->first();
            if ($Rcheck) {

                $values = array();
                $values["password"] = sha1(request()->post("password"));
                DB::table("rc_users")->where("id", $user->id)->update($values);

                RC_redirect("account/password?success=true");
            } else {
                RC_redirect("account/password?error=true");
            }
        });
        $out = $form->get();
        //$out = $form->redirect(base_url("account/update?save=true"))->get();

        echo view(RC_urlView("layout/layout"), ["container" => $out]);
    }

    public function notification() {
        RC_access();
        $user = user();
        $out = "";
        $content = "";

        $block = Block::creat(false, " ");

        $q = DB::table("tb_notification")->where("user", $user->id)->orderBy("id", "DESC")->get();
        foreach ($q as $r):
            $content .= view(RC_urlView("view/account/notification"), ["r" => $r]);
        endforeach;

        $values = array();
        $values["view"] = 1;
        DB::table("tb_notification")->where("user", $user->id)->update($values);

        $block->inject($content);

        $block->span(RC_link("إضافة جديد", secure_url(RC_uri(1) . "/form/insert")));
        $out = $block->get(RC_urlForm("block_lists")); // block end ..

        echo view(RC_urlView("layout/layout"), ["container" => $out]);
    }

    public function calc() {
        RC_access();
        $user = user();
        $out = "";
        $content = "";

        $block = Block::creat(false, " ");

        $content .= view(RC_urlView("view/account/calc"), ["user_id" => $user->id, "user_data" => $user]);
        $block->inject($content);

        $block->span(RC_link("إضافة جديد", secure_url(RC_uri(1) . "/form/insert")));
        $out = $block->get(RC_urlForm("block_lists")); // block end ..

        echo view(RC_urlView("layout/layout"), ["container" => $out]);
    }

    private function commission_data() {
        $inputs = array();
        $index = array();
        
        //   user ..
        $input = Input::creat(RC_IN_hidden, "user", false);
        $input = $input->value( $this->user->id)->check(null)->col(12);
        $inputs[] = $input->get();

        // name ..
        $input = Input::creat(RC_IN_TEXT, "name", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // amount ..
        $input = Input::creat(RC_IN_num, "amount", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();
        
        // bank ..
        $input = Input::creat(RC_IN_TEXT, "bank", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // content ..
        $input = Input::creat(RC_IN_TEXTAREA, "content", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // image ..
        $input = Input::creat(RC_IN_IMAGE, "image", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function commission() {
        RC_access();
        $user = $this->user;

        $form = Form::creat("insert")->db(null, "tb_commission"); // from creat

        $block = Block::creat(true, "سداد العمولة")->btn(true, "إرسال"); // block creat
        
         $block->inject(view(RC_urlView("view/account/commission")));
        
        if (request()->get("save") == true):
            $block->inject(div(div("تم إرسال طلب السداد الي الإدارة وسيتم الرد عما قريب .", "alert alert-success "), "col-md-12"));
        endif;
        $block->inject($this->commission_data()->form);
        $container = $block->get(RC_urlForm("block_form")); // block end ..
        // form end
        $form->inject($container);
        $out = $form->redirect(base_url("account/commission?save=true"))->get();

        echo view(RC_urlView("layout/layout"), ["container" => $out]);
    }

}
