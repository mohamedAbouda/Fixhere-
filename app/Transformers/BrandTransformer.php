<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class BrandTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['models'];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($brand)
    {
        return [
            'id' => $brand->id,
            'name' => $brand->name,
        ];
    }

    public function includeModels($brand)
    {
        if ($brand->models) {
            return $this->collection($brand->models, new ModelTransformer);
        }
    }
}
