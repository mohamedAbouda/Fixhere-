<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\User;
use App\Models\Request as ClientRequest;
use App\Models\RequestSchedule;
use App\Product;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;

class RequestController extends Controller
{
	public function send(Request $request)
	{
		if(!$request->input('product_id')){
			return response()->json([
				'error' => ['Please Provide product id.'],
			],422);
		}
		$product = Product::where('id',$request->input('product_id'))->first();
		if(!$product){
			return response()->json([
				'error' => ['No Spell Part with this id.'],
			],404);
		}
		$data['spell_part'] = $request->input('product_id');
		$data['user_id'] = $request->user()->id;
		$data['price'] = $request->input('price') ? $request->input('price'):0;
		$createRequest = ClientRequest::create($data);
		$schedule['request_id'] = $createRequest->id;
		$schedule['day_date'] = Carbon::now()->format('Y-m-d');
		$schedule['day_time'] = Carbon::now()->format('h:i:s');
		$createSchedule = RequestSchedule::create($schedule);
		// this if to sent to specific users not all users
		// assume you have person how if fixing android but not fixing ios we will send to android only
		$this->chekAgents($product->is_android_part,$product->is_ios_part,$product->delivery,$request->user()->city_id,$createRequest->id);
		return response()->json([
			'success' => ['Your request has been sent ,we will notify you when someone accepts it and you can check your request status at any time.'],
		],200);
	}

	public function schedule(Request $request)
	{
		if(!$request->input('product_id') || !$request->input('day_date')
		 || !$request->input('day_time')){
			return response()->json([
				'error' => ['Please Provide spell id , day date and day time.'],
			],422);
		}
		$data['spell_part'] = $request->input('product_id');
		$data['user_id'] = $request->user()->id;
		$data['price'] = $request->input('price') ? $request->input('price'):0;
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
		$this->sendClientRequest(2,$checkRequest->user->device_id);
		$checkSchedule = RequestSchedule::where('request_id',$request->input('request_id'))
							->first();
		if($checkSchedule){
			$checkSchedule->delete();
		}

		return response()->json([
			'success' => ['done.'],
		],200);
	}

	public function getRequests(Request $request)
	{
		$requests = ClientRequest::where('user_id',$request->user()->id)->with('agent','product');
		if($request->input('status'))
			$requests->where('status',$request->input('status'));
		$requests = $requests->get();
		return response()->json([
			'data' => $requests,
		],200);
	}

	public function agentGetRequests(Request $request)
	{
		$requests = ClientRequest::where('agent_id',$request->user()->id)->with('user','product');
		if($request->input('status'))
			$requests->where('status',$request->input('status'));
		$requests = $requests->get();
		return response()->json([
			'data' => $requests,
		],200);
	}

	public function chekAgents($android_part,$ios_part,$delivery,$city_id,$request_id)
	{
		if($android_part == 1){
			$tokens = User::where('android_fix',1)->where('city_id',$city_id)->pluck('device_id')->toArray();
			if($tokens)
			$this->sendRequest('New Request','New Request hurry up','request',$request_id,$tokens);
		}
		if($ios_part == 1){
			$tokens = User::where('ios_fix',1)->where('city_id',$city_id)->pluck('device_id')->toArray();
			if($tokens)
			$this->sendRequest('New Request','New Request hurry up','request',$request_id,$tokens);
		}
		if($delivery == 1){
			$tokens = User::where('delivery',1)->where('city_id',$city_id)->pluck('device_id')->toArray();
			if($tokens)
			$this->sendRequest('New Request','New Request hurry up','request',$request_id,$tokens);
		}
	}
}
