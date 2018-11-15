<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ModelTransformer extends TransformerAbstract
{
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
}
