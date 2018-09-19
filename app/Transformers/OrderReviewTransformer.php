<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\OrderReview;

class OrderReviewTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(OrderReview $review)
    {
        return [
            'id' => $review->id,
            'rate' => $review->rate,
            'review' => $review->review,
        ];
    }
}
