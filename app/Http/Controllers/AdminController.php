<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $model;
    public function __construct()
    {
        $this->model = new Admin;

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
        $data = $this->model->where('name', 'like', '%' . $search . '%')->paginate(10);
        $data->appends(['search' => $search]);

        return view('admin.index', data: [
            'admin' => $data,
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
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $admin = Admin::query()->create(
            [
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'level' => 0,
            ]
        );
        // $this->model->create($request->validated());
        return redirect()->back()->with('success', "Insert success");
    }
    public function process_login(Request $request)
    {
        try {
            $user = Admin::query()->where('email', $request->email)->firstOrFail();

            if (Hash::check($request->get('password'),  $user->password) || $request->password == $user->password) {
                session()->put('id', $user->id);
                session()->put('name', $user->name);
                session()->put('level', $user->level);
                return redirect()->route('admin.index');
            }
        } catch (\Throwable $th) {
            return 1;
            // return redirect()->route('login')->withErrors(['msg' => 'Dang nhap sai']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit', data: [
            "ad" => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        Admin::where('id', $admin->id)->update($request->validated());
        return redirect()->back()->with('success', "Edit success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->where('id', $id)->delete();
        return redirect()->back()->with('success', "Delete success");
    }
}