<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class ClientTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'contact_number' => $user->contact_number,
            'location' => $user->location,
            'profile_image_url' => $user->profile_image_url
        ];
    }
}
