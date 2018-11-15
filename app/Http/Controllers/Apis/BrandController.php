<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\BrandTransformer;
use App\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::get();

        return response()->json([
            'status' => 'true',
            'data' => fractal()
            ->collection($brands)
            ->transformWith(new BrandTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }
}
