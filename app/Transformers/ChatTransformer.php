<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
// use App\Chat;

class ChatTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($chat)
    {
        return [
            'id' => $chat->id,
            'message' => $chat->message,
            'order_id' => $chat->order_id,
            'sender_id' => $chat->sender_id,
            'sender_type' => $chat->sender_type,
        ];
    }
}
