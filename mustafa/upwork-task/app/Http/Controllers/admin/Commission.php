<?php

namespace App\Http\Controllers\admin;

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

class Commission extends ControllerAmin {

    public $table;

    public function __construct() {
        
    }

    private function data() {
        $inputs = array();
        $index = array();

        $user = RC_user()->id;

        // user ..
        $input = Input::creat(RC_IN_select, "user", false);
        $input = $input->db(null, "rc_users", "username");
        $input = $input->value($user);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // name ..
        $input = Input::creat(RC_IN_TEXT, "name", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // amount ..
        $input = Input::creat(RC_IN_TEXT, "amount", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // bank ..
        $input = Input::creat(RC_IN_TEXT, "bank", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // content ..
        $input = Input::creat(RC_IN_TEXT, "content", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // image ..
        $input = Input::creat(RC_IN_IMAGE, "image", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // oredr for table .. <i class="far fa-times"></i>
        $oredrs_btn = function ($r) {
            if ($r->status == null) {
                $btn = RC_link('<i class="fas fa-check"></i>', RC_url("commission/status/{$r->id}?status=1"), "btn btn-success");
                $btn .= " " . RC_link('<i class="fas fa-times"></i>', RC_url("commission/status/{$r->id}?status=2"), "btn btn-danger");
            } else {
                if ($r->status == 1) {
                    $btn = div("تم قبول الدفعه" , "alert alert-success text-center");
                } else {
                    $btn = div("تم رفض الدفعه" , "alert alert-danger text-center");
                }
            }

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

        $block = Block::creat(false, RC_lang("title"));
        $content = Tbl::creat($this->data()->index)->get();
        $block->inject($content);

//        $block->span(RC_link("إضافة جديد", RC_url(RC_uri(1) . "/form/insert")));
        $container = $block->get();

        // layout ..
        echo view('admin/layout/layout', ["container" => $container]);
    }

    public function form() {
        RC_access();
        $out = "";

        abort(404);

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

    public function status() {
        RC_access();

        $status = request()->get("status");
        $id = uri(3);

        $r = DB::table("tb_commission")->where("id", $id)->first();
        if ($r) {
            $values = array();
            $values["status"] = $status;
            DB::table("tb_commission")->where("id", $id)->update($values);

            if ($status == 1) {
                $user = @user($r->user);
                $credit = floatval(@$user->credit);
                $commission = floatval(@$user->commission);

                if ($commission >= $r->amount) {
                    $commission = $commission - $r->amount;
                } else {
                    $credit = ($r->amount - $commission) + $credit;
                    $commission = 0;
                }

                $values = array();
                $values["commission"] = $commission;
                $values["credit"] = $credit;
                DB::table("rc_users")->where("id", $r->user)->update($values);
            }
        }


        RC_redirect(RC_uri(1));
    }

    public function delete() {
        RC_access();
        echo RC_dbDelete();
        RC_redirect(RC_uri(1));
    }

}
