<?php

namespace App\Http\Controllers\admin;

use App\RC\Form;
use App\RC\Input;
use App\RC\Tbl;
use App\RC\Block;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Users extends ControllerAmin {

    public $table;

    function __construct() {
        $this->table = "rc_users";
    }

    private function data() {
        $inputs = array();
        $index = array();

        /*
          // image ..
          $input = Input::creat(RC_IN_IMAGE, "image", false);
          $input = $input->check(null);
          $inputs[] = $input->get();
          $index = array();
         */

        // username ..
        $input = Input::creat(RC_IN_TEXT, "username", false);
        $input = $input->check(2);
        $inputs[] = $input->get();
        $index[] = $input->tbl([1])->arr();

        // mobile ..
        $input = Input::creat(RC_IN_mobile, "mobile", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl([1])->arr();

        // email ..
        $input = Input::creat(RC_IN_email, "email", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl([1])->arr();

        // type ..
        $input = Input::creat(RC_IN_SELECT, "type", false);
        $input = $input->check(1)->db(null, "tb_user_type");
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // group ..
        $input = Input::creat(RC_IN_SELECT, "group", false);
        $input = $input->check(null)->db(null, "rc_usergroup");
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // password ..
        if (RC_uri(3) == "insert"):
            $input = Input::creat(RC_IN_password, "password", false);
            $input = $input->check(4);
            $inputs[] = $input->get();
        endif;

        // oredr for table ..
        $oredrs_btn = function ($r) {
            $btn = "";
            if ($r->type == 2 && $r->active == 0) {
                $btn .= RC_link('<i class="fas fa-check"></i>', RC_url(RC_uri(1) . "/active/{$r->id}?status=1"), "btn btn-success") . " ";
                $btn .= RC_link('<i class="fas fa-times"></i>', RC_url(RC_uri(1) . "/active/{$r->id}?status=2"), "btn btn-danger") . " ";
            }


            $btn .= RC_link('<i class="far fa-edit"></i>', RC_url(RC_uri(1) . "/form/update/{$r->id}"), "btn btn-dark") . " ";
            return $btn;
        };
        $input = Input::creat(RC_IN_CONTENT, "order_btn", false)->value($oredrs_btn);
        $index[] = $input->tbl(1)->arr();

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {
        RC_access();
        $container = "";

        $block = Block::creat(false);
        $content = Tbl::creat($this->data()->index)->get();
        $block->inject($content);

        $block->span(RC_link("إضافة جديد", RC_url(RC_uri(1) . "/form/insert")));
        $container = $block->get();

        // layout ..
        echo view('admin/layout/layout', ["container" => $container]);
    }

    public function form() {
        RC_access();
        $out = "";

        $form = Form::creat(); // from creat

        $block = Block::creat(false); // block creat
        $block->inject($this->data()->form);
        $container = $block->get(); // block end ..
        // form end
        $form->inject($container);
        $out = $form->get();

        // layout ..
        echo view(RC_urlLayout("layout"), ["container" => $out]);
    }

    public function delete() {
        RC_access();
        RC_dbDelete();
        RC_redirect(RC_uri(1));
    }

    public function active() {

        $id = RC_uri(3);
        $status = request()->get("status");

        $value = array();
        $value["active"] = $status;
        DB::table("rc_users")->where("id", $id)->update($value);

        $values = array();
        $values["user"] = $id;
        if ($status == 1):
            $values["content"] = "تم تفعيل حسابك من قبل الإدارة ، يمكنك الآن الإستمتاع بكافة خصائص الموقع";
        else:
            $values["content"] = "للأسف تم رفض تفعيل حسابك من قبل الإدارة .";
        endif;
        $values["owner"] = 0;
        $values["view"] = 0;
        $values["date_insert"] = RC_dateCurrent();
        DB::table("tb_notification")->insert($values);

        RC_redirect(RC_uri(1));
    }

}
