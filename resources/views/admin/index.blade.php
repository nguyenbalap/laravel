@extends('layout.master')
@section('body')
    <nav class="navbar navbar-light bg-light justify-content-between">
        <a href="{{ route('admin.create') }}" class="text-primary">
            <i class="fas fa-plus"></i>
        </a>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search"
                value="{{ $search }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>

    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Level</th>
            {{-- @if (checkSuperAdmin()) --}}
            <th>
                Action
            </th>
            {{-- @endif --}}
        </tr>

        @foreach ($admin as $key => $each)
            <tr>
                <td>{{ $each->id }}</td>
                <td>{{ $each->name }}</td>
                <td>{{ $each->email }}</td>
                <td>{{ $each->level === 0 ? 'Staff' : 'Admin' }}</td>
                {{-- @if (checkSuperAdmin()) --}}
                <td>
                    <div class="d-flex flex-row">
                        {{-- <a href="{{ route('admin.edit', $each) }}" class="mr-2">
                            <i class="fas fa-edit"></i>
                        </a> --}}
                        <form method="post" action="{{ route('admin.destroy', $each) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-danger" style="border: 0;background: 0;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
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
                    {{ $admin->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection
