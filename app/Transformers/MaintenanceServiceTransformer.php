<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class MaintenanceServiceTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($service)
    {
        return [
            'id' => $service->id,
            'name' => $service->name,
            'tech_fee' => $service->tech_fee,
            'model_id' => $service->model_id,
            'is_android_part' => $service->is_android_part,
            'is_ios_part' => $service->is_ios_part,
            'is_delivery_part' => $service->is_delivery_part,
        ];
    }

}
