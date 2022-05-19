@extends('layout.master');
@section('body')
    <div class="table-responsive" style="height: 300px;">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $each)
                    <tr>
                        <td>{{ $each->id }}</td>
                        <td><img src="{{ $each->image }}" alt="#" style="height: 100px;">
                        </td>
                        <td>{{ $each->name }}</td>
                        <td>{{ $each->description }}</td>
                        <td>{{ $each->price }}</td>
                        <td>{{ $each->quantity }}</td>
                        <td>{{ $each->quantity * $each->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @switch($status)
        @case(0)
            <form action="{{ route('orders.update', $each) }}" method="post">
                @csrf
                @method('PUT')
                <button class="btn btn-warning mr-2">
                    Phê Duyệt
                </button>
            </form>
            <form method="post" action="{{ route('orders.destroy', $each) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    Hủy
                </button>
            </form>
        @break

        @case(1)
            <form action="{{ route('orders.update', $each) }}" method="post">
                @csrf
                @method('PUT')
                <button class="btn btn-info mr-2">
                    Giao hàng ngay
                </button>
            </form>
        @break

        @case(2)
            <form action="{{ route('orders.update', $each) }}" method="post">
                @csrf
                @method('PUT')
                <button class="btn btn-success mr-2">
                    Hoàn thành ngay
                </button>
            </form>
        @break

        @case(3)
            <h4 class="text-success mt-4">Hoàn Thành</h4>
        @break

        @case(4)
            <h4 class="text-danger mt-4">Đã Hủy</h4>
        @break

        @default
    @endswitch
@endsection
