@extends('layout.master');
@section('body')
    <form action="{{ route('blogs.update', $blog) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $blog->id }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{ $blog->title }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Content</label>
            <textarea type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter content"
                name="content">{{ $blog->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">footer</label>
            <textarea type="text" class="form-control" placeholder="Enter footer" name="footer">{{ $blog->footer }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="text" class="form-control" placeholder="Enter image url" name="image"
                value="{{ $blog->image }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
