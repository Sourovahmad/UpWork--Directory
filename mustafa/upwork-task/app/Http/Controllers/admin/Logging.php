<?php

namespace App\Http\Controllers\admin;

use App\RC;
use App\RC\Trans;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Logging extends ControllerAmin {

    public $table;

    function __construct() {
        $this->table = "rc_users";
    }

    public function index() {

        $email = request()->post("email");
        $password = sha1(request()->post("password"));
        $submit = request()->post("submit");

        $container = "";
        if ($submit == 1):
            $r = DB::table($this->table)->where("email", $email)->where("password", $password)->first();
            if (empty($r)):
                $container = RC_div("خطأ في كلمة المرور أو البريد الإلكتروني", "alert alert-danger");
            else:
//                request()->session()->put('user', $r->id);
//            request()->session()->save();
                //session(['user' => $r->id]);
                setcookie("user", $r->id, time() + (8640000 * 3000), "/"); // 86400 = 1 day
                return redirect(RC_url());
            endif;
        endif;
        echo view('admin/layout/login', ["content" => $container]);
    }

    public function logout() {
        request()->session()->forget('user');
        if (isset($_COOKIE['user'])) {
            unset($_COOKIE['user']);
            setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp
        }
        return redirect(RC::url("logging"));
    }

}
