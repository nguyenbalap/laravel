<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShopingCart;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $model;
    public function __construct()
    {
        $this->model = new Order;

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' / ', $arr);
        $header = $arr[0];
        view()->share('title', $title);
        view()->share('header', $header);
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        $data = $this->model->where('name', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $data->appends(['search' => $search]);

        return view('orders.index', data: [
            'orders' => $data,
            'search' => $search,
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
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orders = new Order;
        $orders->name = $request->customer['name'];
        $orders->phone = $request->customer['phone'];
        $orders->address = $request->customer['address'];

        $orders->total_money = $request->total_money;
        $orders->customer_id = $request->customer['customerId'];
        $orders->save();

        // Order::query()->create([
        //     "name" => $request->customer->name,
        //     "total_money" => $request->total_money,
        //     "customer_id" => $request->customer->customerId,
        // ]);
        $maxId = Order::select("orders")->max('id');
        $cart = ShopingCart::where('customer_id', $request->customer['customerId'])->get();
        foreach ($cart as $each) :
            OrderDetail::create([
                "order_id" => $maxId,
                "product_id" => $each['product_id'],
                "quantity" => $each['quantity'],
            ]);
        endforeach;

        ShopingCart::where('customer_id', $request->customer['customerId'])->delete();
        // return $t;
        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $details = (new OrderDetail)->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.*', 'order_details.quantity as quantity')
            ->where('order_details.order_id', $order->id)->get();

        return view("orders.edit", data: [
            'details' => $details,
            'status' => $order->status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        Order::where('id', $order->id)
            ->update(['status' => $order->status + 1]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Order::where('id', $order->id)->update(['status' => 4]);
        return redirect()->back();
    }
}