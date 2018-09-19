<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\RegionTransformer;
use App\Region;
use App\City;

class RegionController extends Controller
{
    public function allRegions(Request $request)
    {
    	$regions = Region::where('id','!=',null);
    	if($request->input('city_id')){
    		$regions->where('city_id',$request->input('city_id'));
    	}
    	$regions = $regions->get();
    	return response()->json(
           fractal()
            ->collection($regions)
            ->transformWith(new RegionTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);
    }
}
