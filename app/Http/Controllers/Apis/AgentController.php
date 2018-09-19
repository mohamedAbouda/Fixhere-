<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\AgentTransformer;
use App\User;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereHas('roles' ,function($query){
            $query->where('name' ,'=' ,'agent');
        })->get();

        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->collection($users)
            ->transformWith(new AgentTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,User $agent)
    {
        if (!$agent->id) {
            $agent = $request->user();
        }
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($agent)
            ->transformWith(new AgentTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }
}
