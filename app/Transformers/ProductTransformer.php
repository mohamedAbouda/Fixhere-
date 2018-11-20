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
            'model_id' => $product->model_id,
            'price' => $product->price,
            'is_android_part' => $product->is_android_part,
            'is_ios_part' => $product->is_ios_part,
            'is_delivery_part' => $product->is_delivery_part,
            'maintenance_service_id' => $product->maintenance_service_id,
        ];
    }

    public function includeModel($product)
    {
        if ($product->model) {
            return $this->item($product->model, new ModelTransformer);
        }
    }
    public function includeService($product)
    {
        if ($product->maintenanceService) {
            return $this->item($product->maintenanceService, new MaintenanceServiceTransformer);
        }
    }
}
