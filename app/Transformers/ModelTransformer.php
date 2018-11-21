<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ModelTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['products'];
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

    public function includeProducts($brand)
    {
        if ($brand->products) {
            return $this->collection($brand->products, new ProductTransformer);
        }
    }
}
