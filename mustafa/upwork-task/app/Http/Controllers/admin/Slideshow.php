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

class Slideshow extends ControllerAmin {

    public $table;

    public function __construct() {
        
    }

    private function data() {
        $inputs = array();
        $index = array();

        // title ..
        $input = Input::creat(RC_IN_TEXT, "title", true);
        $input = $input->check(4);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // image ..
        $input = Input::creat(RC_IN_IMAGE, "image", false);
        $input = $input->check(1);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

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
        RC_access();
        $container = "";

        $block = Block::creat(false);
        $content = Tbl::creat($this->data()->index)->get();
        $block->inject($content);

        $block->span(RC_link("إضافة جديد", RC_url( RC_uri(1) . "/form/insert")));
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
      echo  RC_dbDelete();
       RC_redirect(RC_uri(1));
    }

}