<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\ProductStore;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Quantity;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['products' => ProductResource::collection(Product::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request)
    {
        if (Product::checkForDuplicate($request->name, $request->price))
        {
            Product::addUpToQantity($request->name, $request->price);

            $response = response()->json(['status' => 'add up to quantity']);
        } else {
            $product = Product::create($request->validated());
            $product->quantity = 1;
            $product->save();

            $response = response()->json(['status' => 'created']);
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
        $product = Product::findOrFail($id);
        return response()->json(['product' => new ProductResource($product)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStore $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());
        return response()->json(['status' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['status' => 'deleted']);
    }
}
