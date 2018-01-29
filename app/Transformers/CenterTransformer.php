<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class CenterTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $center)
    {
        return [
            'id' => $center->id,
            'name' => $center->name,
            'email' => $center->email,
            'contact_number' => $center->contact_number,
            'location' => $center->location,
            'cost_per_hour'=>$center->cost_per_hour,
            'cover_image_url' => $center->cover_image_url,
            'description' => $center->description,
            'lat' => $center->lat,
            'lng' => $center->lng,
        ];
    }

    
}
