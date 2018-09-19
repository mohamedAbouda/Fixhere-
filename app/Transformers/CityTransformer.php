<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\City;

class CityTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(City $city)
    {
        return [
            'id' => $city->id,
            'name' => $city->name,
        ];
    }
}
