<?php

namespace App\Http\Controllers;

use App\Models\ShopingCart;
use App\Http\Requests\StoreShopingCartRequest;
use App\Http\Requests\UpdateShopingCartRequest;
use Illuminate\Http\Request;

class ShopingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $t = new ShopingCart;

        $product = $t->join('products', 'shoping_carts.product_id', '=', 'products.id')
            ->select('products.*', 'shoping_carts.quantity as quantity')->where('shoping_carts.customer_id', $request->user_id)
            ->get();
        return response()->json([
            "status" => 200,
            "message" => 'success',
            "products" => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShopingCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopingCartRequest $request)
    {
        //
    }
    public function get_user_cart(Request $request)
    {
        $cart =  (new ShopingCart)->query()->where('customer_id', $request->user_id)->get();
        return response()->json($cart);
    }
    public function add_new_item(Request $request)
    {
        $cart = new ShopingCart;

        $cart->customer_id = $request->customer_id;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json('success');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopingCart  $shopingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShopingCart $shopingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopingCart  $shopingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopingCart $shopingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopingCartRequest  $request
     * @param  \App\Models\ShopingCart  $shopingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopingCart $shopingCart)
    {
        ShopingCart::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->update(['quantity' => $request->quantity]);
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopingCart  $shopingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopingCart $shopingCart)
    {
        //
    }
}