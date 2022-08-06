<?php

namespace App\Http\Controllers\admin\settings;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ControllerSettings extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
