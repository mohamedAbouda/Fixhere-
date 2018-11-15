<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ProductTransformer;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

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
