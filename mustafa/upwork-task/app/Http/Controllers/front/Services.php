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

class Services extends Controller {

    public $table;

    private function data() {
        $inputs = array();
        $index = array();
        $user = user();

        // image ..
        $input = Input::creat(RC_IN_IMAGE, "image", false);
        $input = $input->check(0)->col(12);
        $inputs[] = $input->get();


        // title ..
        $input = Input::creat(RC_IN_TEXT, "title", true);
        $input = $input->check(3)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // parent ..
        $input = Input::creat(RC_IN_select, "parent", false);
        $input = $input->db(["user" => $user->id], "tb_hospital");
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // price ..
        $input = Input::creat(RC_IN_num, "price", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // discount ..
        $input = Input::creat(RC_IN_num, "discount", false);
        $input = $input->check(0)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

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
