<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'teams'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'image_url' => $user->image ? $user->image_url : '',
            'social_image' => $user->social_image ? $user->social_image : '',
            'city' => $user->city ? $user->city : '',
            'area' => $user->area ? $user->area : '',
        ];
    }

    public function includeTeams(User $user)
    {
        if($user->memberInTeams || $user->adminOfTeams){
            $teams = $user->memberInTeams()->get()->merge($user->adminOfTeams()->get());
            return $this->collection($teams,new SimpleTeamTransformer);
        }
    }

}
