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

class Times extends Controller {

    public $table;

    private function data() {
        $inputs = array();
        $index = array();
        $user = user();
        $uri_3 = uri(3);
        $uri_4 = uri(4);

        // parent ..
        $input = Input::creat(RC_IN_select, "parent", false);
        $input = $input->db(["user" => $user->id], "tb_hospital");
        $input = $input->ajax("section" , "feature = 14 AND parent");
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // section ..
        $input = Input::creat(RC_IN_select, "section", false);
//        $input = $input->db(["user" => $user->id, "feature" => 14 , "parent"=> request()->post("parent")], "tb_feature");
        $input = $input->db(["user" => $user->id, "feature" => 14 , "parent"=> "ajax:parent"], "tb_feature");
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // title ..
        $input = Input::creat(RC_IN_date, "title", false);
        $input = $input->check(1)->col(10, true);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        $inputs[] = div("<a class='btn btn-dark d-block btn_add_input_time mt-3'>توقيت جديد آخر</a>", "col-md-2 pt-3 mt-1 wrap_btn_add_input_time mb-3");

        // content ..
        if ($uri_3 == "insert"):
            $input = Input::creat(RC_IN_time, "details[]", false);
            $input = $input->wrap_class("wrap_input_time");
            $input = $input->check(0)->col(6);
            $inputs[] = $input->get();
        endif;

        if ($uri_3 == "update"):
            $r = DB::table("tb_feature")->where("id", $uri_4)->first();
            if ($r && $r->details) {
                $times = explode(",", $r->details);
                foreach ($times as $time) {
                    $input = Input::creat(RC_IN_time, "details[]", false);
                    $input = $input->value($time);
                    $input = $input->wrap_class("wrap_input_time");
                    $input = $input->check(0)->col(6, true);
                    $inputs[] = $input->get();
                }
            }
        endif;

        // user ..
        $input = Input::creat(RC_IN_hidden, "user", false);
        $input = $input->value($user->id);
        $input = $input->check(0)->col(12);
        $inputs[] = $input->get();

        // oredr for table ..
        $oredrs_btn = function ($r) {
            $btn = RC_link('تعديل', RC_url(RC_uri(1) . "/form/update/{$r->id}"), "btn btn-success") . " ";
            $btn .= RC_link('حذف', "javascript:void(0)", "btn btn-danger btn_delete", ["rel" => RC_url(RC_uri(1) . "/delete?id={$r->id}")]);
            return $btn;
        };
        $input = Input::creat(RC_IN_CONTENT, "oredrs_btn", false)->value($oredrs_btn);
        $index[] = $input->tbl(1)->arr();

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {
        RC_access();
        $user = user();
        $container = "";

        $block = Block::creat(false, " ");
        $content = Tbl::creat($this->data()->index, false)->db(["user" => $user->id])->get();
        $block->inject($content);

        $block->span(RC_link("إضافة جديد", secure_url(RC_uri(1) . "/form/insert")));
        $container = $block->get(RC_urlForm("block_form")); // block end ..
        // layout ..
        echo view('front/layout/layout', ["container" => $container]);
    }

    public function form() {
        RC_access();
        $out = "";

        $form = Form::creat(); // from creat
        $block = Block::creat(true)->btn(true, RC_lang("button_title")); // block creat
        $block->inject($this->data()->form);
        $container = $block->get(RC_urlForm("block_form")); // block end ..
        // form end
        $form->inject($container);
        $out = $form->get();

        // layout ..
        echo view(RC_urlLayout("layout"), ["container" => $out]);
    }

    public function delete() {
        RC_access();
        echo RC_dbDelete();
        RC_redirect(RC_uri(1));
    }

}
