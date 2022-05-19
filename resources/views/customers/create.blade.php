@extends('layout.master');
@section('body')
    <form action="{{ route('customers.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" placeholder="Enter address" name="address">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Phone</label>
            <input type="text" class="form-control" placeholder="Enter phone" name="phone">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Avatar</label>
            <input type="text" class="form-control" placeholder="Enter avatar url" name="avatar">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Gender</label>
            Male <input type="radio" class="form-control" name="gender" value="0">
            Female <input type="radio" class="form-control" name="gender" value="1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
