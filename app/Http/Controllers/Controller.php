<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function generateRandomString($length){ 
    	$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    	$charsLength = strlen($characters) -1;
    	$string = "";
    	for($i=0; $i<$length; $i++){
    		$randNum = mt_rand(0, $charsLength);
    		$string .= $characters[$randNum];
    	}
    	return $string;
    }
}
