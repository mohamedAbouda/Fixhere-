<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ClientUpdateRequest;
use App\Transformers\ClientTransformer;
use App\User;

class ClientController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($user)
            ->transformWith(new ClientTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function edit(ClientUpdateRequest $request)
    {
        $user = $request->user();
        $user->update($request->all());
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($user)
            ->transformWith(new ClientTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }
}
