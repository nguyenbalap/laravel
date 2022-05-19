@extends('layout.master');
@section('body')
    <form action="{{ route('producers.update', $producer) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $producer->id }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $producer->name }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email"
                value="{{ $producer->email }}">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" placeholder="Enter address" name="address"
                value="{{ $producer->address }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Phone</label>
            <input type="text" class="form-control" placeholder="Enter phone" name="phone"
                value="{{ $producer->phone }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="text" class="form-control" placeholder="Enter image url" name="image"
                value="{{ $producer->image }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
