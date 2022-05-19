<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $admin = Customer::query()->create(
            [

                'password' => Hash::make($request->password),
                "name" => $request->name,
                "address" => $request->address,
                "phone" => $request->phone,
                "gender" => $request->gender,
                "email" => $request->email,
                "avatar" => $request->avatar,
            ]
        );
        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);
    }
    public function process_login(Request $request)
    {
        try {
            $user = Customer::query()->where('email', $request->email)->firstOrFail();

            if (!Hash::check($request->get('password'),  $user->password)) {
                throw new \Exception('Invalid password');
            }
            return response()->json([
                "user_id" => $user->id,
                "name" => $user->name,
                "avatar" => $user->avatar,
                "email" => $user->email,
                "address" => $user->address,
                "phone" => $user->phone,

                "token" => csrf_token(),
                'status' => 200,
                'message' => 'success',
            ]);
            // else {
            //     return response()->json([
            //         'status' => 404,
            //         'message' => 'not found',
            //     ]);
            // }
        } catch (\Throwable $th) {
            report($th);

            return response()->json([
                'status' => 404,
                "message" => "Invalid email address or password",
            ]);
            // return redirect()->route('login')->withErrors(['msg' => 'Dang nhap sai']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}