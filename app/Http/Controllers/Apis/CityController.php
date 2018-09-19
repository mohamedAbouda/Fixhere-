<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\CityTransformer;
use App\City;

class CityController extends Controller
{
    public function allCities()
    {
    	$cities = City::all();

    	return response()->json(
           fractal()
            ->collection($cities)
            ->transformWith(new CityTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);
    }
}
