<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Order;

class OrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'client','technician','region','service','pickup','reviews'
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
            'description' => $order->description,
            'lat' => $order->lat,
            'lng' => $order->lng,
            'status' => $order->status,
        ];
    }

    public function includeClient(Order $order)
    {
        if ($order->client) {
            return $this->item($order->client ,new ClientTransformer);
        }
    }

     public function includeTechnician(Order $order)
    {
        if ($order->technician) {
            return $this->item($order->technician ,new AgentTransformer);
        }
    }


    public function includeRegion(Order $order)
    {
        if ($order->region) {
            return $this->item($order->region ,new RegionTransformer);
        }
    }


    public function includeService(Order $order)
    {
        if ($order->service) {
            return $this->item($order->service ,new ServiceTransformer);
        }
    }

    public function includePickup(Order $order)
    {
        if ($order->pickup) {
            return $this->collection($order->pickup ,new PickupTransformer);
        }
    }

    public function includeReviews(Order $order)
    {
        if ($order->reviews) {
            return $this->collection($order->reviews ,new OrderReviewTransformer);
        }
    }


}
