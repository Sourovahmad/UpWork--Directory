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

class Contact extends Controller {

    private function data() {
        $inputs = array();
        $index = array();

        // name ..
        $input = Input::creat(RC_IN_TEXT, "name", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // mobile ..
        $input = Input::creat(RC_IN_mobile, "mobile", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // email ..
        $input = Input::creat(RC_IN_email, "email", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();

        // content ..
        $input = Input::creat(RC_IN_TEXTAREA, "content", false);
        $input = $input->check(4)->col(12);
        $inputs[] = $input->get();
        
        $inputs[] = view(RC_urlView("view/contact/button"));

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {


        $form = Form::creat("insert"); // from creat
        $form->inject($this->data()->form);
        $out = $form->redirect(base_url("contact?save=true"))->get();

        $container = view(RC_urlView("view/contact/index"), ["content" => $out]);

        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

}
