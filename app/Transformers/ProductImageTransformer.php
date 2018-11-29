<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\ProductImage;

class ProductImageTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = ['service', 'model'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ProductImage $productImage)
    {
        return [
            'id' => $productImage->id,
            'image' => $productImage->image_url,
        ];
    }
}
