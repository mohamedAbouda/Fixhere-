<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\User;
use App\Models\Request as ClientRequest;
use App\Models\RequestSchedule;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function send(Request $request)
    {
    	if(!$request->input('spell_part_id')){
    		 return response()->json([
                'error' => [
                    'Please Provide spell id.'
                ],
            ],422);
    	}
    	$data['spell_part'] = $request->input('spell_part_id');
    	$data['status'] = 1;
    	$data['user_id'] = $request->user()->id;
    	$data['request_type'] = 'android';
    	$createRequest = ClientRequest::create($data);
    	$tokens = User::where('device_id','!=',null)->pluck('device_id')->toArray();
    	$this->sendRequest('New Request','New Request hurry up','request',$createRequest->id,$tokens);
    }
}
