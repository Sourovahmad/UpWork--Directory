<?php

namespace App\Http\Controllers\front;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Home extends Controller {

    public function index() {
        $container = view( RC_urlView("view/home"));
        echo view(RC_urlView("layout/layout"), ["container" => $container]);
    }

}
