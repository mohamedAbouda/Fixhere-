<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\AgentTransformer;
use App\Models\RequestSpellPart;
use App\User;
use App\Models\AgentReview;

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

    public function review(Request $request)
    {
        if(!$request->input('agent_id') || !$request->input('rate')){
            return response()->json([
                'error' => 'Please provide agent id and rate.',
            ],422);
        }
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $createReview = AgentReview::create($data);
        return response()->json([
            'success' => 'review submited.',
        ],200);
    }

    public function requestSpellPart(Request $request)
    {
        if(!$request->input('spell_part_id')){
            return response()->json([
                'error' => 'Please provide spell part id.',
            ],422);
        }
        $data = $request->all();
        $data['agent_id'] = $request->user()->id;
        $createSpellPartRequest = RequestSpellPart::create($data);
        return response()->json([
            'success' => 'request submited.',
        ],200);
    }
}
