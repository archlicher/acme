<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Order as OrderResource;
use App\Http\Requests\OrderUpdate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class LogisticsController extends Controller
{
    public function listAllOrders()
    {
        $shippingOrders = Order::where('shipped', true)->get();
        $forShippingOrders = Order::where('shipped', false)->get();

        return response()->json([
            'shippedOrder' => OrderResource::collection($shippingOrders),
            'forShippingOrders' => OrderResource::collection($forShippingOrders)
        ]);
    }

    public function transferToShipping(OrderUpdate $request, $id)
    {
        $tranferToForShippingOrder = Order::where('shipped', false)->find($id);
        // $tranferToForShippingOrder->update($request->validated());
        // $tranferToForShippingOrder->addTrackingNumber($request->trackingNumber);
        // $tranferToForShippingOrder->addShippingDate($request->shippingDate);
        // $tranferToForShippingOrder->addShippingMethod($request->shippingMethod);
        // $tranferToForShippingOrder->addDeliveryDate($request->deliveryDate);
        $tranferToForShippingOrder->transaction($request);

        return response()->json(new OrderResource($tranferToForShippingOrder));
    }
}
