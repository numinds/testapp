<?php namespace App\Http\Controllers;

//bd use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

//bd	use DispatchesCommands, ValidatesRequests;
        use DispatchesJobs, ValidatesRequests;


}
