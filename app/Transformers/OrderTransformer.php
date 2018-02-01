<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Order;

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'center','agent'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'service_type' => $order->service_type,
            'date' => $order->order_date,
            'time_from' => $order->time_from,
            'time_to' => $order->time_to,
            'lat' => $order->lat,
            'lng' => $order->lng,
            'problem' => $order->problem,
            'agent_id' => $order->agent_id,
            'center_id' => $order->center_id,
            'status' => $order->status,
        ];
    }

    public function includeAgent(Order $order)
    {
        if ($order->agent) {
            return $this->item($order->agent ,new AgentTransformer);
        }
    }

    public function includeCenter(Order $order)
    {
        if ($order->center) {
            return $this->item($order->center ,new CenterTransformer);
        }
    }
}
