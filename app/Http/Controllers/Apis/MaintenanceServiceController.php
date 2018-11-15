<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\MaintenanceServiceTransformer;
use App\MaintenanceService;

class MaintenanceServiceController extends Controller
{
    public function index()
    {
        $services = MaintenanceService::get();

        return response()->json([
            'status' => 'true',
            'data' => fractal()
            ->collection($services)
            ->transformWith(new MaintenanceServiceTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }
}
