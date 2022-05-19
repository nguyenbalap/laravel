@extends('layout.master');
@section('body')
    <form action="{{ route('products.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter price" name="price">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea type="description" class="form-control" placeholder="Enter description" name="description"></textarea>
        </div>
        <div class="form-group">
            <select class="form-select form-select-lg mb-3" name="producer_id">
                <label for="exampleInputPassword1">Producer</label>
                <option selected>Open this select menu</option>
                @foreach ($producers as $each)
                    <option value="{{ $each->id }}">{{ $each->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <select class="form-select form-select-lg mb-3" name="type">
                <label for="exampleInputPassword1">Type</label>
                <option selected>Open this select menu</option>
                @foreach ($arrProductType as $key => $each)
                    <option value="{{ $each }}">{{ $key }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="text" class="form-control" placeholder="Enter image url" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
