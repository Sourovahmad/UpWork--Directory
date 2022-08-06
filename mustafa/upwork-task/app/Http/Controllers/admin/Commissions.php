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

class Commissions extends ControllerAmin {

    public $table;

    public function __construct() {
        $this->table = "rc_users";
    }

    private function data() {
        $inputs = array();
        $index = array();


        // title ..
        $input = Input::creat(RC_IN_TEXT, "username", false);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // mobile..
        $input = Input::creat(RC_IN_TEXT, "mobile", false);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // email..
        $input = Input::creat(RC_IN_TEXT, "email", false);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // commission ..
        $input = Input::creat(RC_IN_TEXT, "commission", false);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {
        
        RC_access();
        $container = "";

        // database ..
        $block = Block::creat(false, RC_lang("title"));


        $content = Tbl::creat($this->data()->index)->db(["commission|>"=>0], "rc_users")->get("tbl_without_delete");

        $block->inject($content);
        $container = $block->get();

        // layout ..
        echo view('admin/layout/layout', ["container" => $container]);
    }

}
