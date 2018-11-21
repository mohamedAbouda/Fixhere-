<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = ['service', 'model'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'thumbnail' => $product->thumbnail_url,
            'views' => $product->views,
            'stock' => $product->stock,
            'price' => $product->price,
            'maintenance_service_id' => $product->maintenance_service_id,
        ];
    }

    public function includeService($product)
    {
        if ($product->maintenanceService) {
            return $this->item($product->maintenanceService, new MaintenanceServiceTransformer);
        }
    }
}
