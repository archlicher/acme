<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Order as OrderResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStore;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(OrderResource::collection(Order::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStore $request)
    {
        if (Order::create($request->validated()))
        {
            $response = response()->json(['status' => 201]);
        } else {
            $response = response()->json(['status' => 'Wrong arguments']);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json(new OrderResource($order));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStore $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());
        return response()->json(new OrderResource($order));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['status' => 'deleted']);
    }

    public function checkStatus($id)
    {
        $order = Order::findOrFail($id);
        $order->checkStatus();
        return response()->json(new OrderResource($order));
    }
}
