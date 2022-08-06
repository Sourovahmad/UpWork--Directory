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

class Contact extends ControllerAmin {

    public $table;

    public function __construct() {
        
    }

    private function data() {
        $inputs = array();
        $index = array();

        // name ..
        $input = Input::creat(RC_IN_TEXT, "name", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl([1])->arr();

        // mobile ..
        $input = Input::creat(RC_IN_TEXT, "mobile", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl([1])->arr();

        // content ..
        $input = Input::creat(RC_IN_TEXT, "content", false);
        $input = $input->check(4);
        $inputs[] = $input->get();
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

        $container = $block->get();

        $value = array();
        $value["view"] = 1;
        db_update(["view" => 0, "type" => 0], "tb_contact", $value, false);

        // layout ..
        echo view('admin/layout/layout', ["container" => $container]);
    }

    public function delete() {
        RC_access();
        echo RC_dbDelete();
        RC_redirect(RC_uri(1));
    }

}
