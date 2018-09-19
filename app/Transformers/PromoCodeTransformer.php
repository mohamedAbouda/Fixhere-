<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\PromoCode;

class PromoCodeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(PromoCode $promocode)
    {
        return [
            'id' => $promocode->id,
            'code' => $promocode->code,
            'value' => $promocode->value,
            'is_valid' => $promocode->is_valid,
        ];
    }
}
