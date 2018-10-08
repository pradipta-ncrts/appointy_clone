<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\model\common_model;
use App\Http\Controllers;

use DateTime;



abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $adminTableObj;

    function __construct(Request $params){
    	//load tabales for admin
        $this->adminTableObj = new TablesController();
        //Load Model
        $this->common_model = new common_model();

        $this->timeZone = new DateTime();
    }

}


