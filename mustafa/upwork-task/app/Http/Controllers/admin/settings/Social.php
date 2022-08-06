<?php

namespace App\Http\Controllers\admin\settings;

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

class Social extends ControllerSettings {

    public $table;

    public function __construct() {
        
    }

    private function data2() {

        // button orders ...
        $oredrs_btn = function ($r) {
            $btn = RC_link('<i class="far fa-edit"></i>', RC_url("settings/" . RC_uri(1) . "/form/update/{$r->id}"), "btn btn-dark");
            return $btn;
        };

        $inputs = array();

        // title ..
        $inputs[] = Input::creat(RC_IN_TEXT, "title", true)->check(3)->tbl([1])->get();

        // select ..
        $option = array();
        $option["fab fa-facebook-f"] = "فيس بوك";
        $option["fab fa-twitter"] = "تويتر";
        $option["fab fa-instagram"] = "إنستقرام";
        $option["fab fa-youtube"] = "يوتيوب";
        $option["fab fa-youtube"] = "يوتيوب";
        $option["fab fa-linkedin-in"] = "لينكد إن";
        $option["fab fa-snapchat-ghost"] = "سناب شات";
        $inputs[] = Input::creat(RC_IN_select, "details", false)->option($option)->check(1)->get();

        // content
        $inputs[] = Input::creat(RC_IN_url, "content", false)->check(3)->get();

        // orders btn table ..
        $inputs[] = Input::creat(RC_IN_CONTENT, "oredrs_btn", false)->value($oredrs_btn)->hide(true)->tbl(1)->get();
        return $inputs;
    }

    private function data() {
        $inputs = array();
        $index = array();

        // title ..
        $input = Input::creat(RC_IN_TEXT, "title", true);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // details ..
        $input = Input::creat(RC_IN_select, "details", false);
        $option = array();
        $option["fab fa-facebook-f"] = array("فيس بوك", "fab fa-facebook-f");
        $option["fab fa-twitter"] = array("تويتر", "fab fa-twitter");
        $option["fab fa-instagram"] = array("إنستقرام", "fab fa-instagram");
        $option["fab fa-youtube"] = array("يوتيوب", "fab fa-youtube");
        $option["fab fa-youtube"] = array("يوتيوب", "fab fa-youtube");
        $option["fab fa-linkedin-in"] = array("لينكد إن", "fab fa-linkedin-in");
        $option["fab fa-snapchat-ghost"] = array("سناب شات", "fab fa-snapchat-ghost");
        $option["fab fa-whatsapp"] = array("وتساب", "fab fa-whatsapp");
        $input = $input->option($option);
        $input = $input->check(1);
        $inputs[] = $input->get();
//        $index[] = $input->tbl(1)->arr();

        // content ..
        $input = Input::creat(RC_IN_URL, "content", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
//        $index[] = $input->tbl(1)->arr();

        // oredr for table ..
        $oredrs_btn = function ($r) {
            $btn = RC_link('<i class="far fa-edit"></i>', RC_url("settings/".RC_uri(1) . "/form/update/{$r->id}"), "btn btn-dark");
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
        $container = "";

        $block = Block::creat(false);
        $content = Tbl::creat($this->data()->index)->get();
        $block->inject($content);

        $settings = (request()->segment(2) == "settings") ? "/settings" : "";
        $block->span(RC_link("إضافة جديد", secure_url("rc-admin$settings/" . RC_uri(1) . "/form/insert")));
        $container = $block->get();

        // layout ..
        echo view('admin/layout/layout', ["container" => $container]);
    }

    public function form() {
        RC_access();
        $out = "";

        $form = Form::creat(); // from creat

        $block = Block::creat(true); // block creat
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
        echo RC_dbDelete();
        RC_redirect("settings/".RC_uri(1));
    }

}
