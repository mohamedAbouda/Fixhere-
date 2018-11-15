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
        ];
    }

}
