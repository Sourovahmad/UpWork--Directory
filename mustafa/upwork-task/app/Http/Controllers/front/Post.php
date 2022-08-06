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

class Post extends Controller {

    private function data() {
        $inputs = array();
        $index = array();

        $user = RC_user()->id;

        // image ..
        $input = Input::creat(RC_IN_IMAGE, "image", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();
        //  $index[] = $input->tbl(1)->arr();
        // title ..
        $input = Input::creat(RC_IN_TEXT, "title", true);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // section ..
        $input = Input::creat(RC_IN_SELECT, "section", false);
        $input = $input->check(1)->col(12);
        $input = $input->db(["feature" => 8]);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // city ..
        $input = Input::creat(RC_IN_SELECT, "city", false);
        $input = $input->check(1)->col(12);
        $input = $input->db(["feature" => 5]);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // target..
        $input = Input::creat(RC_IN_SELECT, "target", false);
        $input = $input->check(1)->col(12);
        $input = $input->db(["feature" => 9]);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // price ..
        $input = Input::creat(RC_IN_num, "price", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // space ..
        $input = Input::creat(RC_IN_TEXT, "space", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // face ..
        $input = Input::creat(RC_IN_TEXT, "face", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // street ..
        $input = Input::creat(RC_IN_TEXT, "street", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // bedroom ..
        $input = Input::creat(RC_IN_TEXT, "bedroom", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // hall ..
        $input = Input::creat(RC_IN_TEXT, "hall", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // bathroom ..
        $input = Input::creat(RC_IN_TEXT, "bathroom", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // apartment ..
        $input = Input::creat(RC_IN_TEXT, "apartment", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // age ..
        $input = Input::creat(RC_IN_TEXT, "age", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // content ..
        $input = Input::creat(RC_IN_TEXTAREA, "content", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // location ..
        $input = Input::creat(RC_IN_MAP, "location", false);
        $input = $input->check(1)->col(12);
        $inputs[] = $input->get();

        // user ..
        $input = Input::creat(RC_IN_hidden, "user", false);
        $input = $input->value($user);
        $inputs[] = $input->get();

        // oredr for table ..
        $oredrs_btn = function ($r) {
            $btn = RC_link('<i class="far fa-edit"></i>', RC_url(RC_uri(1) . "/form/update/{$r->id}"), "btn btn-dark");
            return $btn;
        };
        $input = Input::creat(RC_IN_CONTENT, "oredrs_btn", false)->value($oredrs_btn);
        $index[] = $input->tbl(1)->arr();

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {

        $search_title = request()->get("title");
        $search_section = request()->get("section");
        $search_target = request()->get("target");
        $search_city = request()->get("city");

        $q = DB::table("tb_post");
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
            $content .= view(RC_urlView("view/post/block"), ["r" => $r]);
        endforeach;

        if (count($q) == 0):
            $content = div("لا توجد عقارات متاحة الآن .", "text-center mt-5 pt-5");
        endif;

        $title = "آخر العقارات المضافة";
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

    public function favorite() {
        
        RC_access(); 
        $Arr_id = array();
        $user = user();
        $Qfav = DB::table("tb_order")->where("user", $user->id)->get();
        foreach ($Qfav as $Rfav):
            $Arr_id[] = $Rfav->post;
        endforeach;

        $q = DB::table("tb_post");
        $q->whereIn("id", $Arr_id);
        $q = $q->get();

        $content = "";

        foreach ($q as $r):
            $content .= view(RC_urlView("view/post/block"), ["r" => $r]);
        endforeach;

        if (count($q) == 0):
            $content = div("لا توجد عقارات متاحة الآن .", "text-center mt-5 pt-5");
        endif;

        $title = "مفضلتي";

        $data = array();
        $data["title"] = $title;
        $data["content"] = $content;
        $container = view(RC_urlView("common/container"), $data);
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function v() {

        $id = uri(3);
        $r = DB::table("tb_post")->where("id", $id)->first();
        if (empty($r)) {
            abort(404);
        }

        $values = array();
        $values["visited"] = $r->visited + 1;
        DB::table("tb_post")->where("id", $r->id)->update($values);

        $container = view(RC_urlView("view/post/v"), ["r" => $r]);
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function insert() {
        RC_access(); 
        $uri_2 = uri(2);
        $id = uri(3);
        if ($uri_2 == "update") {
            $title = "تعديل العقار";
            $form = Form::creat("update")->db(["id" => $id], "tb_post"); // from creat
        } else {
            $title = "إضافة عقار جديد";
            $form = Form::creat("insert")->db("", "tb_post"); // from creat
        }



        $block = Block::creat(true, $title)->btn(true, "حفظ "); // block creat
        if (request()->get("save") == true):
            $block->inject(div(div("تم حفظ العقار بنجاح", "alert alert-success "), "col-md-12"));
        endif;
        $block->inject($this->data()->form);
        $container = $block->get(RC_urlForm("block_form")); // block end ..
        // form end
        $form->inject($container);
        $out = $form->redirect(base_url("post/lists?save=true"))->get();

        echo view(RC_urlView("layout/layout"), ["container" => $out]);
    }

    public function update() {
        RC_access(); 
        $uri_2 = uri(2);
        $id = uri(3);
        if ($uri_2 == "update") {
            $title = "تعديل العقار";
            $form = Form::creat("update")->db(["id" => $id], "tb_post"); // from creat
        } else {
            $title = "إضافة عقار جديد";
            $form = Form::creat("insert")->db("", "tb_post"); // from creat
        }

        $block = Block::creat(true, $title)->btn(true, "حفظ "); // block creat

        $block->inject($this->data()->form);
        $container = $block->get(RC_urlForm("block_form")); // block end ..
        // form end
        $form->inject($container);
        $out = $form->redirect(base_url("post/lists?save=true"))->get();

        echo view(RC_urlView("layout/layout"), ["container" => $out]);
    }

    public function lists() {
        RC_access(); 


        // config ..
        $user = user();

        // database ..
        $q = DB::table("tb_post");
        $q->where([["user", "=", $user->id]]);
        $q = $q->get();

        $content = "";
        if (request()->get("save") == true):
            $content .= div(div("تم حفظ العقار بنجاح", "alert alert-success "), "col-md-12");
        endif;
        foreach ($q as $r):
            $content .= view(RC_urlView("view/post/block"), ["r" => $r]);
        endforeach;

        if (count($q) == 0):
            $content = div("لا توجد عقارات متاحة الآن .", "text-center mt-5 pt-5");
        endif;

        $title = "عقاراتي ";

        $data = array();
        $data["title"] = $title;
        $data["content"] = $content;
        $container = view(RC_urlView("common/container"), $data);
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

    public function delete() {
        RC_access();

        $id = uri(3);

        echo RC_dbDelete(["id" => $id], "tb_post");
        RC_redirect("post/lists");
    }

}
