<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ChatTransformer;
use App\Order;
use App\Chat;
use DB;

class ChatController extends Controller
{
    public function chats(Request $request)
    {
        $user = $request->user();
        // $order_ids = Order::where('user_id' ,$user->id)->pluck('id')->toArray();
        // $chats = Chat::whereIn('order_id' ,$order_ids)->orderBy('id' ,'DESC')->get();
        $chats = Chat::whereHas('order' ,function($query) use($user){
            $query->where('user_id' ,$user->id);
        })->orderBy('id' ,'DESC')->get();
        $chats = $chats->unique('order_id');

        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->collection($chats)
            ->transformWith(new ChatTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }

    public function chat(Request $request)
    {
        $order_id = $request->get('order_id');
        if (!$order_id) {
            return response()->json([
                'status' => 'false',
                'message' => 'order_id is required.'
            ],422);
        }
        $user = $request->user();
        $chat_messages = Chat::where('order_id' ,$order_id)->whereHas('order' ,function($query) use($user){
            $query->where('user_id' ,$user->id);
        })->orderBy('id' ,'DESC')->get();

        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->collection($chat_messages)
            ->transformWith(new ChatTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }

    public function send(Request $request)
    {
        $input = $request->only(['message' ,'order_id']);
        $user = $request->user();

        /**
         * check if this user is an agent or a client
         */
        $order = Order::where(function($query) use ($user){
            $query->where('technician_id' ,$user->id)
            ->orWhere('user_id' ,$user->id);
        })->where('id' ,$request->get('order_id'))->exists();

        if (!$order) {
            return response()->json([
                'status' => 'false',
                'message' => 'Order not found.'
            ],404);
        }

        $input['sender_id'] = $user->id;
        if ($user->hasRole(['superadmin' ,'admin'])) {
            $input['sender_type'] = Chat::SENDER_TYPE_ADMIN;
        }
        if ($user->hasRole(['agent'])) {
            $input['sender_type'] = Chat::SENDER_TYPE_AGENT;
        }
        if ($user->hasRole(['client'])) {
            $input['sender_type'] = Chat::SENDER_TYPE_CLIENT;
        }

        // dd($input);
        Chat::create($input);

        return response()->json([
            'status' => 'true',
            'message' => 'Message sent successfully.'
        ],200);
    }
}
