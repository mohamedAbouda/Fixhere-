<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\CenterTransformer;
use App\User;
class CenterController extends Controller
{
    public function nearbyCenters(Request $request)
    {
    	
    	$centers = User::whereHas('roles', function ($query) {
            $query->where('name','center');
        });
        if($request->input('lat') && $request->input('lng')){
        	$ids = [];
    		$center = new User;
    		$centersId = $center->getByDistance($request->input('lat'),$request->input('lng'),5);
    		foreach($centersId as $center){
    			array_push($ids, $center->id);
    		}
    		$centers->whereIn('id',$ids);
        }
        $centers = $centers->get();

		return response()->json(
           fractal()
            ->collection($centers)
            ->transformWith(new CenterTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);

    	
    }

    public function recentCenters()
    {
        $centers = User::whereHas('roles', function ($query) {
            $query->where('name','center');
        })->orderBy('id','desc')->get();

        return response()->json(
           fractal()
            ->collection($centers)
            ->transformWith(new CenterTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);
    }

    public function centerDetails(Request $request)
    {
    	if(!$request->input('center_id')){
            return response()->json([
                'error' => [
                    'Please Provide Center Id.'
                ],
            ],402);
        }
        $center = User::where('id',$request->input('center_id'))->first();
         if(!$center){
            return response()->json([
                'error' => [
                    'No Center found with this id.'
                ],
            ],404);
        }
        	return response()->json(
           		fractal()
            	->item($center)
            	->transformWith(new CenterTransformer)
            	->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            	->toArray()
        	,200);
    }
}
