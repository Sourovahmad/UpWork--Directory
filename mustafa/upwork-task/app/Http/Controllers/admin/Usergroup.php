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

class Usergroup extends ControllerAmin {

    public $table;

    public function __construct() {
        
    }

    private function data() {
        $inputs = array();
        $index = array();

        // title ..
        $input = Input::creat(RC_IN_TEXT, "title", false);
        $input = $input->check(2);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        $query = DB::table("rc_menu")->where([["parent", 0], ["permission", 1]])->get();
        foreach ($query as $row):

            $checkbox = "";
            $checkbox .= div(h5(label(input("checkbox", "", "ml-1 check_all", array("rel" => $row->id)) . $row->title), "mb-0 pb-0 pt-2") . hr("mt-0"), "col-md-12 ");

            $q = DB::table("rc_menu");
            if ($row->id == 1):
                $q = $q->where([["parent", 2], ["permission", 1]]);
            else:
                $q = $q->where([["parent", $row->id], ["permission", 1]]);
            endif;
            $q = $q->get();

            foreach ($q as $r):
                $input = Input::creat(RC_IN_CHECKBOOX, "permission[]", false);
                $input = $input->col(3, true)->title($r->title)->value($r->id)->class("check_child_$row->id");
                $checkbox .= $input->get();
            endforeach;
            $inputs[] = div(div($checkbox, "row"), "col-md-12 bg-light mt-3 rounded-lg pt-2 pb-2 border ");
        endforeach;

        // oredr for table ..
        $oredrs_btn = function ($r) {
            $btn = RC_link('<i class="far fa-edit"></i>', RC_url(RC_uri(1) . "/form/update/{$r->id}"), "btn btn-dark");
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

}

//      $x = "test  =  2 AND id = 3 OR X = 9 AND z      = 4 AND E = 1 OR c = 0 AND r = 9";
        //       $parts = preg_split('/\s+/', $x );