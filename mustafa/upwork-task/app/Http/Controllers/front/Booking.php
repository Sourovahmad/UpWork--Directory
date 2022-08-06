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

class Booking extends Controller {

    public $table;
    public $user;

    function __construct() {
        $this->table = "tb_cart";
        $this->user = user();
    }

    public function index() {
        RC_access();
        $container = "";

        // database ..
        $q = DB::table($this->table)->orderBy("id", "DESC");
        if ($this->user->type == 1) {
            $q = $q->where("user", $this->user->id);
        } else {
            $q = $q->where("owner", $this->user->id);
        }
        $q = $q->get();

        $block = Block::creat(false, " ");

        $lists = "";
        foreach ($q as $r):
            $lists .= view(RC_urlView("view/booking/block"), ["r" => $r, "user_type" => $this->user->type]);
        endforeach;

        if (count($q) == 0):
            $lists = div("لا توجد حجوزات متاحة الآن  .", "col-md-12 mt-5 pt-5 text-center");
        endif;

        if ($this->user->type == 2) :
            $values = array();
            $values["view"] = 1;
            DB::table("tb_cart")->where("owner", @$this->user->id)->where("view", 0)->update($values);
        endif;

        $block = $block->inject($lists);
        $container = $block->get(RC_urlForm("block_lists")); // block end ..

        echo view('front/layout/layout', ["container" => $container]);
    }

    public function status() {

        $status = request()->get("case");
        $refused = request()->post("refused");

        $id = uri(3);

        $R = DB::table($this->table)->where("id", $id)->first();
        if ($R) {
            $values = array();
            $values["status"] = $status;
            if ($refused):
                $values["refused"] = $refused;
            endif;

            DB::table($this->table)->where("id", $id)->update($values);

            $content = "تم رفض حجز برقم كودي ({$R->code})";
            if ($status == 1):
                $content = "تم الموافقة على حجز برقم كودي ({$R->code})  يرجى الحضور قبل 10 دقائق من الموعد ، ويمكنك تعديل أو إلغاء موعدك في حالة عدم تمكنك من الحضور ( الموعد : {$R->time} والتاريخ : " . @RC_trans(@RC_feature($R->date)->title) . " )";
            endif;

            if ($status == 3):
                $content = "تم  تنفيذ حجز برقم كودي ({$R->code})  يمكنك الان تقييم الخدمة";
            endif;

            if ($status == 4):
                $content = "تم  إلغاء حجز برقم كودي ({$R->code}) بسبب " . $refused;
            endif;

            $values = array();
                $values["parent"] = $R->id;
            $values["user"] = $R->owner;
            $values["owner"] = $R->user;
            $values["content"] = $content;
            $values["view"] = 0;
            $values["date_insert"] = RC_dateCurrent();
            DB::table("tb_notification")->insert($values);

            $values = array();
            $values["parent"] = $R->id;
            $values["user"] = $R->user;
            $values["owner"] = $R->owner;
            $values["content"] = $content;
            $values["view"] = 0;
            $values["date_insert"] = RC_dateCurrent();
            DB::table("tb_notification")->insert($values);

            //commission
            if ($status == 3):

                $values = array();
                $values["commission"] = floatval(@$user->commission) + $R->commission;
                DB::table("rc_users")->where("id", $R->user)->update($values);
            endif;
        }



        RC_redirect(uri(1) . "?success=1");
    }

    public function update() {

        $id = intval(uri(3));

        $r = DB::table("tb_cart")->where("id", $id)->first();
        if (empty($r)):
            abort(404);
        endif;

        $block = Block::creat(false, " ");
        $block = $block->inject(view('front/view/booking/update', ["r" => $r]));
        $container = $block->get(RC_urlForm("block_lists")); // block end ..


        if (request()->post("submit") == 1) {

            if (request()->post("date") > 0 && request()->post("time") != "") {

                $values = array();
                $values["date"] = request()->post("date");
                $values["time"] = request()->post("time");
                DB::table("tb_cart")->where("id", $id)->update($values);

                $content = "تم تعديل موعد الحجز إلي الساعة " . request()->post("time") . " والتاريخ : " . @RC_trans(@RC_feature(request()->post("date"))->title);

                $values = array();
                $values["parent"] = $r->id;
                $values["user"] = $r->owner;
                $values["owner"] = $r->user;
                $values["content"] = $content;
                $values["view"] = 0;
                $values["date_insert"] = RC_dateCurrent();
                DB::table("tb_notification")->insert($values);

                RC_redirect("booking/update/$id?success=true");
            } else {
                RC_redirect("booking/update/$id?error=true");
            }
        }

        echo view('front/layout/layout', ["container" => $container]);
    }

}
