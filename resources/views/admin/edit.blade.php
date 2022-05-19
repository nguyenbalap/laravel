@extends('layout.master');
@section('body')
    <form action="{{ route('admin.update', $ad) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $ad->id }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $ad->name }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email"
                value="{{ $ad->email }}">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Level</label>
            <input type="text" class="form-control" placeholder="Enter address" name="level" value="{{ $ad->level }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Enter phone" name="password"
                value="{{ $ad->password }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
