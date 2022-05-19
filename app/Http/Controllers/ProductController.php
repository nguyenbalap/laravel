<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Producer;
use Illuminate\Http\Request;


use App\Enums\ProductEnumType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $model;
    public function __construct()
    {
        $this->model = new Product;

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' / ', $arr);
        $header = $arr[0];

        $arrProductType = ProductEnumType::getArrayView();
        view()->share('title', $title);
        view()->share('header', $header);
        view()->share('arrProductType', $arrProductType);
    }
    public function index(Request $request)
    {
        $search = $request->get('search');
        $product = $this->model->join('producers', 'products.producer_id', '=', 'producers.id')
            ->select('products.*', 'producers.name as producer_name')
            ->where('products.name', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(5);

        $product->appends(['search' => $search]);

        return view('products.index', data: [
            'products' => $product,
            'search' => $search,
        ]);
    }
    public function process_paging($page)
    {
        $length = (new Product)->count();
        $skip = ($page - 1) * 12;
        $data = Product::offset($skip)->limit(12)->get();
        return response()->json([
            'products' => $data,
            'length' => $length,
        ]);
    }
    public function allProducts()
    {
        $all = $this->model->select('products.*')->orderBy('created_at', 'desc')->offset(0)
            ->limit(10)->get();
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'products' => $all,
        ]);
    }
    public function product_details(Request $request)
    {
        $productInfo =  Product::find($request->productId);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'productInfo' => $productInfo,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producers = Producer::all();
        return view('products.create', data: ["producers" => $producers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->back()->with('success', "Insert success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $producers = Producer::all();

        return view('products.edit', data: [
            "product" => $product,
            "producers" => $producers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        Product::where('id', $product->id)->update($request->validated());
        return redirect()->back()->with('success', "Edit success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->where('id', $id)->delete();
        return redirect()->back()->with('success', "Delete success");
    }
}