<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\User;
use App\Models\Request as ClientRequest;
use App\Models\RequestSchedule;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;

class RequestController extends Controller
{
	public function send(Request $request)
	{
		if(!$request->input('spell_part_id')){
			return response()->json([
				'error' => ['Please Provide spell id.'],
			],422);
		}
		$data['spell_part'] = $request->input('spell_part_id');
		$data['user_id'] = $request->user()->id;
		$data['request_type'] = 'android';
		$createRequest = ClientRequest::create($data);
		$schedule['request_id'] = $createRequest->id;
		$schedule['day_date'] = Carbon::now()->format('Y-m-d');
		$schedule['day_time'] = Carbon::now()->addMinutes(15)->format('h:i:s');
		$createSchedule = RequestSchedule::create($schedule);
		$tokens = User::where('device_id','!=',null)->pluck('device_id')->toArray();
		$this->sendRequest('New Request','New Request hurry up','request',$createRequest->id,$tokens);
		return response()->json([
			'success' => ['Your request has been sent ,we will notify you when someone accepts it and you can check your request status at any time.'],
		],200);
	}

	public function schedule(Request $request)
	{
		if(!$request->input('spell_part_id') || !$request->input('day_date')
		 || !$request->input('day_time')){
			return response()->json([
				'error' => ['Please Provide spell id , day date and day time.'],
			],422);
		}
		$data['spell_part'] = $request->input('spell_part_id');
		$data['user_id'] = $request->user()->id;
		$data['request_type'] = 'android';
		$createRequest = ClientRequest::create($data);
		$schedule['request_id'] = $createRequest->id;
		$schedule['day_date'] = $request->input('day_date');
		$schedule['day_time'] = $request->input('day_time');
		$createSchedule = RequestSchedule::create($schedule);
		return response()->json([
			'success' => ['Your request has been scheduled ,you can check your request status at any time.'],
		],200);
	}

	public function accept(Request $request)
	{
		if(!$request->input('request_id')){
			return response()->json([
				'error' => ['Please Provide request id.'],
			],422);
		}
		$checkRequest = ClientRequest::where('id',$request->input('request_id'))->first();
		if(!$checkRequest){
			return response()->json([
				'error' => ['No request with this id.'],
			],404);
		}
		if($checkRequest->agent_id && $checkRequest->status != 1){
			return response()->json([
				'success' => ['some technical agent accepted this request before.'],
			],200);
		}
		$updateRequest = $checkRequest->update(['agent_id'=>$request->user()->id,'status'=>2]);
		$checkSchedule = RequestSchedule::where('request_id',$request->input('request_id'))
							->first();
		if($checkSchedule){
			$checkSchedule->update(['approved'=>1]);
		}

		return response()->json([
			'success' => ['done.'],
		],422);
	}
}
