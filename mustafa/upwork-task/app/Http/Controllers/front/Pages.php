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

class Pages extends Controller {

    public function v() {

        $id = uri(3);
        $r = DB::table("tb_feature")->where("feature", 2)->where("id", $id)->first();
        if (empty($r)) {
            abort(404);
        }

        $container = view(RC_urlView("view/pages/v"), ["r" => $r]);
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

}
