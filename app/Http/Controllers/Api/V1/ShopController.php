<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\ShopStoreRequest;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = auth()->user()->role == 'seller' ? $shops = auth()->user()->shops() : Shop::query();

        return $this->responseSuccess($shops->paginate(3), 'Shops retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopStoreRequest $request)
    {
        if (auth()->user()->role == 'seller') {
            $shop = auth()->user()->shops()->create($request->validated());
        } else {
            $shop = new Shop($request->validated());
            $shop->seller_id = $request->seller_id;
            $shop->save();
        }

        return $this->responseSuccess($shop, 'Shop created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return $this->responseSuccess($shop, 'Shop retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
