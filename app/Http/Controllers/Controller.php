<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

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

    public function sendRequest($title,$body,$object_name,$object_id,$tokens)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
        ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([$object_name => $object_id]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    }

    public function sendClientRequest($stauts,$tokens)
    {
        $body = '';
        if($stauts == 2){
            $body = 'some technical agent has accepted your request';
        }
        if($stauts == 3){
            $body = 'some technical agent has completed your request';
        }
       $optionBuilder = new OptionsBuilder();
       $optionBuilder->setTimeToLive(60*20);

       $notificationBuilder = new PayloadNotificationBuilder('Your Order has been updated');
       $notificationBuilder->setBody($body)
       ->setSound('default');

       $dataBuilder = new PayloadDataBuilder();
       $dataBuilder->addData(['data' => 'there are nothing here bitch , go fuck yourself']);

       $option = $optionBuilder->build();
       $notification = $notificationBuilder->build();
       $data = $dataBuilder->build();

       $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
   }

   function generatePIN($digits = 5){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
          $pin .= mt_rand(0, 9);
          $i++;
        }
        return $pin;
    }
}
