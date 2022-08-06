<?php

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\RC;

class Home extends ControllerAmin {

    function __construct() {
        
    }

    public function index() {
        RC::access();

        
//         rc_email("rocsel.eg@gmail.com", "subb", "content");
 
        $container = view("admin/view/home");
          echo view('admin/layout/layout', ["container" => $container]);
       
 
        
    }

}
