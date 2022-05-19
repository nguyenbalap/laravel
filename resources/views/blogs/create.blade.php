@extends('layout.master');
@section('body')
    <form action="{{ route('blogs.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <textarea type="text" class="form-control" name="title" placeholder="Enter title"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Content</label>
            <textarea type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter content" name="content">
            </textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Footer</label>
            <textarea type="text" class="form-control" placeholder="Enter footer" name="footer"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="text" class="form-control" placeholder="Enter image url" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
