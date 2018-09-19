<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class AgentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $agent)
    {
        return [
            'id' => $agent->id,
            'name' => $agent->name,
            'profile_image_url' => $agent->profile_image_url,
        ];
    }
}
