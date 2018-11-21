<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ModelTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['maintenanceServices'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'brand_id' => $model->brand_id,
        ];
    }

    public function includeMaintenanceServices($model)
    {
        if ($model->maintenanceServices) {
            return $this->collection($model->maintenanceServices, new MaintenanceServiceTransformer);
        }
    }
}
