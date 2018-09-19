<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\OrderCreateRequest;
use App\Transformers\OrderTransformer;
use App\Order;
use App\PickupDate;
use App\OrderReview;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $order = Order::create($data);
        return response()->json([
            'status' => 'true',
            'message' => 'Order created successfully.',
        ],200);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $order = order::where('id',$request->input('order_id'))->first();
        $order->update($data);
        return response()->json([
            'status' => 'true',
            'message' => 'Order updated successfully.',
        ],200);
    }

    public function show(Request $request)
    {
        if(!$request->input('order_id')){
            return response()->json([
                'status' => 'false',
                'error' => 'please provide the id.',
            ],404);
        }
        $order = Order::where('id',$request->input('order_id'))->first();
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($order)
            ->transformWith(new OrderTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function pending(Request $request)
    {
       $orders = Order::where('id','!=',null);

       if($request->input('technician_id')){
            $orders->where('technician_id',$request->input('technician_id'));
       }

       if($request->input('user_id')){
            $orders->where('user_id',$request->input('user_id'));
       }
       $orders = $orders->get();

      return response()->json(
           fractal()
            ->collection($orders)
            ->transformWith(new OrderTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);
    }

    public function history(Request $request)
    {
       $orders = Order::where('id','!=',null);

       if($request->input('technician_id')){
            $orders->where('technician_id',$request->input('technician_id'));
       }

       if($request->input('user_id')){
            $orders->where('user_id',$request->input('user_id'));
       }
       $orders = $orders->get();

      return response()->json(
           fractal()
            ->collection($orders)
            ->transformWith(new OrderTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);
    }

    public function pickup(Request $request)
    {
      $data = $request->all();
      if(!$request->input('date') || !$request->input('order_id')){
         return response()->json([
          'status' => 'false',
          'error' => 'please provide the order id and date.',
        ],404);
      }

      $pickup = PickupDate::create($data);
        return response()->json([
          'status' => 'true',
          'message' => 'The pickup date has been created.',
        ],200);
    }

    public function createReview(Request $request)
    {
      $data = $request->all();
      if(!$request->input('order_id') || !$request->input('rate')){
       return response()->json([
        'status' => 'false',
        'error' => 'please provide the order id and rate.',
      ],404);
     }
     $createReview = OrderReview::create($data);
      return response()->json([
          'status' => 'true',
          'message' => 'The order review date has been created.',
        ],200);
   }
}
