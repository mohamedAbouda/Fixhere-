<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\PickupDate;

class PickupTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(PickupDate $pickup)
    {
        return [
            'id' => $pickup->id,
            'date' => $pickup->date,
        ];
    }
}
