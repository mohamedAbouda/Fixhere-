<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ServiceTransformer;
use App\Service;

class ServiceController extends Controller
{
    public function allServices()
    {
    	$services = Service::all();

    	return response()->json(
           fractal()
            ->collection($services)
            ->transformWith(new ServiceTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);
    }
}
