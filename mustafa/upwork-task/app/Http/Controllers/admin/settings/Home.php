<?php

namespace App\Http\Controllers\admin\settings;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\RC;

class Home extends ControllerSettings {

    function __construct() {
        
    }

    public function index() {
        RC::access();
        $user = user();

        $group = user()->group;
        $permission = DB::table("rc_usergroup")->where("id", $group)->first();

        $q = DB::table("rc_menu");
        $where = array();
        $where["parent"] = 2;
        $where["view"] = 1;
        if ($user->id != 1) {
            $where["id|IN"] = explode(",", $permission->permission);
        }

        $q = RC_dbWhere($q, $where);
        //$q = $q->where("parent", 2);
        //$q = $q->where("view", 1);

        $q = $q->get();
        $container = "";
        foreach ($q as $r):
            $container .= view("admin/view/settings/home", ["r" => $r]);
        endforeach;

        echo view('admin/layout/layout', ["container" => RC::div($container, "row")]);
    }

}
