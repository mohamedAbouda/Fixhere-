<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Collection;
use App\Enquiry;

class EnquiryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'from','to'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($enquiry)
    {
        if ($enquiry instanceof Collection) {
            $enquiry = $enquiry->first();
        }
        
        return [
            'id' => $enquiry->id,
            'type' => $enquiry->type,
            'message' => $enquiry->message,
            'title' => $enquiry->title,
            'group' => $enquiry->group,
            'from_user_id' => $enquiry->from,
            'to_user_id' => $enquiry->to,
        ];
    }

    public function includeFrom(Enquiry $enquiry)
    {
        if ($enquiry->fromUser) {
            if ($enquiry->fromUser->hasRule('center')) {
                return $this->item($enquiry->fromUser ,new CenterTransformer);
            }
            return $this->item($enquiry->fromUser ,new ClientTransformer);
        }
    }

    public function includeTo(Enquiry $enquiry)
    {
        if ($enquiry->toUser) {
            if ($enquiry->toUser->hasRule('center')) {
                return $this->item($enquiry->toUser ,new CenterTransformer);
            }
            return $this->item($enquiry->toUser ,new ClientTransformer);
        }
    }
}
