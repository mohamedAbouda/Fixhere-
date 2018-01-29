<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\OrderCreateRequest;
use App\Transformers\OrderTransformer;
use App\Order;

class OrderController extends Controller
{
    public function store(OrderCreateRequest $request)
    {
        $input = $request->all();
        $client = $request->user();
        $input['client_id'] = $client->id;

        $order = Order::create($input);

        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($order)
            ->transformWith(new OrderTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function show(Request $request ,Order $order)
    {
        $client = $request->user();
        if ($client->id !== $order->client_id) {
            return response()->json([
                'status' => 'false',
                'error' => 'Unauthorized to view this content.',
            ],403);
        }

        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($order)
            ->transformWith(new OrderTransformer)
            ->includeAgent()
            ->includeCenter()
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }
}
