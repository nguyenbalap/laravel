<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $model;
    public function __construct()
    {
        $this->model = new Blog;

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
        $data = $this->model->where('title', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
        $data->appends(['search' => $search]);

        return view('blogs.index', data: [
            'blogs' => $data,
            'search' => $search,
        ]);
    }
    public function overview()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->limit(3)->get();
        return response()->json([
            'blogs' => $blogs,
        ]);
    }
    public function blog_detail(Request $request)
    {
        $blog = Blog::where('id', $request->blogId)->first();
        return response()->json([
            'blog' => $blog
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->back()->with('success', "Insert success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', data: [
            "blog" => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        Blog::where('id', $blog->id)->update($request->validated());
        return redirect()->back()->with('success', "Edit success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->where('id', $id)->delete();
        return redirect()->back()->with('success', "Delete success");
    }
}