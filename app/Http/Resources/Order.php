<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'orderNumber' => $this->orderNumber,
            'invoiceNumber' => $this->invoiceNumber,
            'totalAmount' => $this->totalAmount,
            'customerName' => $this->customerName,
            'trackingNumber' => $this->trackingNumber,
            'shippingDate' => $this->shippingDate,
            'shippingMethod' => $this->shippingMethod,
            'deliveryDate' => $this->deliveryDate,
            'owner' => $this->owner,
            'orderStatus' => $this->orderStatus
        ];
    }
}
