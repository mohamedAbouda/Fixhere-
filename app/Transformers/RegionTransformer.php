<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Region;

class RegionTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'city'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Region $region)
    {
        return [
            'id' => $region->id,
            'lat' => $region->lat,
            'lng' => $region->lng,
            'zoom' => $region->zoom,
        ];
    }

    public function includeCity(Region $region)
    {
        if ($region->city) {
            return $this->item($region->city ,new CityTransformer);
        }
    }
}
