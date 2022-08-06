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

class General extends ControllerSettings {

    public $table;

    function __construct() {
        $this->table = "rc_settings";
    }

    public function index() {
        RC_access();
        $out = "";
        $content = "";
        $inputs = array();

        $form = Form::creat("null");

        // block  ===============================================================================>
        $block = Block::creat(true)->title(RC_lang("block_1"))->btn(true); // block creat

        /* title .. */
        $input = Input::creat(RC_IN_TEXT, "title", true);
        $input->check(3)->col(12)->value(settings("title", "ar"));
        $block->inject($input->get());

        // description .. 
        $input = Input::creat(RC_IN_TEXTAREA, "description", true);
        $input->check(3)->col(6, true)->value(settings("description", "ar"));
        $block->inject($input->get());

        // keywords .. 
        $input = Input::creat(RC_IN_TEXTAREA, "keywords", true);
        $input->check(3)->col(6, true)->value(settings("keywords", "ar"));
        $block->inject($input->get());

        $content .= $block->get();

        // block  ===============================================================================>
        $block = Block::creat(true)->title("العمولة")->btn(true); // block creat
        
        // commission
        $input = Input::creat(RC_IN_num, "commission", false);
        $input->check(0)->col(6, true)->value(settings("commission"));
        $block->inject($input->get());

        
        // commission_complement
        $input = Input::creat(RC_IN_num, "commission_complement", false);
        $input->check(0)->col(6 , true)->value(settings("commission_complement"));
        $block->inject($input->get());

        $content .= $block->get();

        // block  ===============================================================================>
        $block = Block::creat(false)->title(RC_lang("block_2"))->btn(true);

        // mobile ..
        $input = Input::creat(RC_IN_mobile, "mobile", false);
        $input->check(0)->col(6, true)->value(settings("mobile"));
        $block->inject($input->get());

        // email ..
        $input = Input::creat(RC_IN_email, "email", false);
        $input->check(3)->col(6, true)->value(settings("email"));
        $block->inject($input->get());

        // whatsapp
        $input = Input::creat(RC_IN_TEXT, "whatsapp", false);
        $input->check(0)->col(6, true)->value(settings("whatsapp"));
        $block->inject($input->get());

        // address
        $input = Input::creat(RC_IN_TEXT, "address", false);
        $input->check(3)->col(6, true)->value(settings("address"));
        $block->inject($input->get());

        $content .= $block->get();

        // block  ===============================================================================>
        $block = Block::creat(false)->title(RC_lang("block_3"))->btn(true); // block creat

        /* location .. */
        $input = Input::creat(RC_IN_MAP, "location", false);
        $input->check(3)->col(12)->value(settings("location"));
        $block->inject($input->get());

        $content .= $block->get();

        /* form end */
        $form->inject($content);
        $out = $form->fun(function () {
                    RC_settings_set();
                })->get();

        echo view('admin/layout/layout', ["container" => $out]);
    }

}
