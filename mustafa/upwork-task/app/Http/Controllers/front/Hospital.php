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

class Hospital extends Controller {

    public $table;
    public $user;

    function __construct() {
        $this->table = "tb_hospital";
        $this->user = user();
    }

    private function data() {
        $inputs = array();
        $index = array();
        $user = user();

        // title ..
        $input = Input::creat(RC_IN_TEXT, "title", true);
        $input = $input->check(3)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // doctor ..
        $input = Input::creat(RC_IN_TEXT, "doctor", false);
        $input = $input->check(3)->col(12);
        $inputs[] = $input->get();

        $input = Input::creat(RC_IN_select, "gender", false)->title(null, RC_lang("gender_placeholder"));
        $input->option("ذكر", 1);
        $input->option("أنثى", 2);
        $input = $input->check(1, 255)->col(12);
        $inputs[] = $input->get();

        $input = Input::creat(RC_IN_select, "section", false)->title(null, RC_lang("section_placeholder"));
        $input->db(["feature" => 8]);
        $input = $input->check(1, 255)->col(12);
        $inputs[] = $input->get();

        $input = Input::creat(RC_IN_select, "city", false)->title(null, RC_lang("city_placeholder"));
        $input->db(["feature" => 5]);
        $input = $input->check(1, 255)->col(12);
        $inputs[] = $input->get();

        //  image ..
        $input = Input::creat(RC_IN_imageMulti, "image", false);
        $input = $input->check(0)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // content ..
        $input = Input::creat(RC_IN_TEXTAREA, "content", true);
        $input = $input->check(3)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // price ..
        $input = Input::creat(RC_IN_num, "price", false);
        $input = $input->check(3)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // price_file ..
        $input = Input::creat(RC_IN_num, "price_file", false);
        $input = $input->check(3)->col(12);
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

    public function lists() {
        RC_access();
        $container = "";

        // database ..
        $q = DB::table($this->table)->where("user", $this->user->id)->get();

        $block = Block::creat(false, " ");

        $lists = "";
        foreach ($q as $r):
            $lists .= view(RC_urlView("view/hospital/block"), ["r" => $r]);
        endforeach;

        if (count($q) == 0):
            $lists = div("لا توجد عيادات متاحة .", "col-md-12 mt-5 pt-5 text-center");
        endif;

        $block = $block->inject($lists);
        $container = $block->get(RC_urlForm("block_lists")); // block end ..

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
        $out = $form->redirect(RC_uri(1) . "/lists")->get();

        // layout ..
        echo view(RC_urlLayout("layout"), ["container" => $out]);
    }

    public function delete() {
        RC_access();
        echo RC_dbDelete();
        RC_redirect(RC_uri(1) . "/lists");
    }

    public function index() {

        $search_title = request()->get("title");
        $search_section = request()->get("section");
        $search_target = request()->get("target");
        $search_city = request()->get("city");
        $date = request()->get("date");

        $q = DB::table($this->table);
        if ($search_title):
            $q->where([["title", "REGEXP", $search_title]]);
        endif;
        if ($search_section):
            $q->where("section", $search_section);
        endif;
        if ($search_target):
            $q->where("target", $search_target);
        endif;
        if ($search_city):
            $q->where("city", $search_city);
        endif;

        if (request()->get("visited") == 1):
            $q->orderBy("visited", "desc");
        endif;

        $q = $q->get();

        $content = "";

        foreach ($q as $r):

            if ($date) {
                $__date = $date;

                $dates = DB::table("tb_feature")->where("feature", 15)->where("parent", $r->id)->where("title", $__date)->get();
                if (count($dates) > 0):
                    $content .= view(RC_urlView("view/hospital/block"), ["r" => $r]);
                endif;
            } else {
                $content .= view(RC_urlView("view/hospital/block"), ["r" => $r]);
            }




        endforeach;

        if (count($q) == 0 || $content == ""):
            $content = div("لا توجد عيادات متاحة الآن .", "text-center mt-5 pt-5");
        endif;

        $title = "آخر العيادات المضافة";
        if (request()->get("section")):
            $section = RC_feature(request()->get("section"));
            $title = RC_trans($section->title);
        endif;
        if (request()->get("search") == 1):
            $title = "نتائج البحث";
        endif;

        if (request()->get("visited") == 1):
            $title = "العقارات الأكثر مشاهدة";
        endif;

        $data = array();
        $data["title"] = $title;
        $data["content"] = $content;
        $container = view(RC_urlView("common/container"), $data);
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function offers() {

        $title = "العروض";

        $q = DB::table("tb_feature")->where("feature", 14)->where("discount", ">", 0)->get();
        $content = "";
        foreach ($q as $r):
            $content .= view(RC_urlView("view/hospital/offer"), ["r" => $r, "col" => 2]);
        endforeach;

        if (count($q) == 0):
            $content = div("لا توجد عروض متاحة الآن .", "text-center mt-5 pt-5");
        endif;

        $data = array();
        $data["title"] = $title;
        $data["content"] = $content;
        $container = view(RC_urlView("common/container"), $data);
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function v() {

        $id = uri(3);
        $r = DB::table($this->table)->where("id", $id)->first();
        if (empty($r)) {
            abort(404);
        }

        $values = array();
        $values["visited"] = $r->visited + 1;
        DB::table($this->table)->where("id", $r->id)->update($values);

        $container = view(RC_urlView("view/hospital/v"), ["r" => $r]);
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function favorite() {

        RC_access();
        $Arr_id = array();
        $user = user();
        $Qfav = DB::table("tb_order")->where("user", $user->id)->get();
        foreach ($Qfav as $Rfav):
            $Arr_id[] = $Rfav->post;
        endforeach;

        $q = DB::table("tb_hospital");
        $q->whereIn("id", $Arr_id);
        $q = $q->get();

        $content = "";

        foreach ($q as $r):
            $content .= view(RC_urlView("view/hospital/block"), ["r" => $r]);
        endforeach;

        if (count($q) == 0):
            $content = div("لا توجد عيادات متاحة الآن .", "text-center mt-5 pt-5 mb-5");
        endif;

        $block = Block::creat(true); // block creat

        $block->inject($content);
        $out = $block->get(RC_urlForm("block_form")); // block end ..


        echo view(RC_urlView("layout/layout"), ["container" => $out]);

        ;
    }

}
