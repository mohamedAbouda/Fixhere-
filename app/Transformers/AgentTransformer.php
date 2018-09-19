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
            'email' => $agent->email,
            'address' => $agent->location,
            'contact_number' => $agent->contact_number,
            'profile_image_url' => $agent->profile_image ? $agent->profile_image_url : '',
        ];
    }
}
