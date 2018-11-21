<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ProductTransformer;
use App\Model;
use App\MaintenanceService;
use App\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('id', '<>', NULL);

        if ($request->get('model_id')) {
            $query->whereHas('maintenanceService', function($query) use($request){
                $query->where('model_id', $request->get('model_id'));
            });
        }

        if ($request->get('brand_id')) {
            $query->whereHas('maintenanceService', function($query) use($request){
                $query->whereHas('model', function($query) use($request){
                    $query->where('brand_id', $request->get('brand_id'));
                });
            });
        }

        $products = $query->get();

        return response()->json([
            'status' => 'true',
            'data' => fractal()
            ->collection($products)
            ->transformWith(new ProductTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }

    public function related(Product $part)
    {
        $brand_id = $part->maintenanceService->brand()->id;
        $models = Model::where('brand_id', $brand_id)->pluck('id');
        $maintenance_services = MaintenanceService::whereIn('id', $models)->pluck('id');
        $products
        return response()->json([
            'status' => 'true',
            'data' => fractal()
            ->collection($products)
            ->transformWith(new ProductTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }
}
