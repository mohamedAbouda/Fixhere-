<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ModelTransformer;
use App\Model;

class ModelController extends Controller
{
    public function index()
    {
        $models = Model::get();

        return response()->json([
            'status' => 'true',
            'data' => fractal()
            ->collection($models)
            ->transformWith(new ModelTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }
}
