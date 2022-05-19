@extends('layout.master')
@section('body')
    <nav class="navbar navbar-light bg-light justify-content-between">
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search"
                value="{{ $search }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>

    <table class="table table-striped">
        <tr>
            <th>
                <div style="text-align: center">
                    #
                </div>
            </th>
            <th>
                <div style="text-align: center">
                    Name
                </div>
            </th>
            <th>
                <div style="text-align: center">
                    Phone
                </div>
            </th>
            <th>
                <div style="text-align: center">
                    Address
                </div>

            </th>
            <th>
                <div style="text-align: center">
                    Date
                </div>
            </th>
            <th>
                <div style="text-align: center">

                    Status
                </div>
            </th>
            <th>
                <div style="text-align: center">

                    Total Money
                </div>
            </th>
            {{-- @if (checkSuperAdmin()) --}}
            <th>
                <div style="text-align: center">
                    Action
                </div>
            </th>
            {{-- @endif --}}
        </tr>
        @foreach ($orders as $key => $each)
            <tr>
                <td>
                    <div style="text-align: center">{{ $each->id }} </div>
                </td>
                <td>
                    <div style="text-align: center">{{ $each->name }} </div>
                </td>
                <td>
                    <div style="text-align: center">{{ $each->phone }} </div>
                </td>
                <td>
                    <div style="text-align: center">{{ $each->address }} </div>
                </td>
                <td>
                    <div style="text-align: center">{{ $each->created_at }} </div>
                </td>
                <td>
                    <div style="text-align: center">{{ $each->get_status_name }} </div>
                </td>
                <td>
                    <div style="text-align: center">{{ $each->total_money }} </div>
                </td>

                {{-- @if (checkSuperAdmin()) --}}
                <td>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-center">
                        <a href="{{ route('orders.edit', $each) }}" class="mr-2 btn btn-primary">
                            Xem chi tiết
                        </a>
                        {{-- {{$each->status === 1 ? }} --}}
                        @switch($each->status)
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
                                        Giao hàng
                                    </button>
                                </form>
                            @break

                            @case(2)
                                <form action="{{ route('orders.update', $each) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success mr-2">
                                        Hoàn Thành
                                    </button>
                                </form>
                            @break

                            @default
                        @endswitch
                        {{-- <a href="{{ route('orders.update', $each) }}" class="mr-2 text-success">
                            <i class="fas fa-check-circle"></i>
                        </a> --}}
                    </div>
                    {{-- <a href="{{route('student.destroy', ['student' => $stud->id] )}}" class="btn btn-edit">Delete</a> --}}
                </td>
                {{-- @endif --}}
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                <ul class="pagination">
                    {{ $orders->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection
