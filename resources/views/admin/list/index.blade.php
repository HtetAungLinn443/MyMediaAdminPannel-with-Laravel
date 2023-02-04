@extends('admin.layouts.app')

@section('title', 'Admin List')

@section('content')

    <div class="col-12">
        <div class="col-3 offset-9">
            @if (session('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>{{ session('deleteSuccess') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Table</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#listSearch') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="adminSearchKey" class="form-control float-right"
                                placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone }}</td>
                                <td>{{ $u->address }}</td>
                                <td>{{ $u->gender }}</td>
                                <td>
                                    @if (Auth::user()->id != $u->id)
                                        <a href="{{ route('admin#accountDelete', $u->id) }}">
                                            <button class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </a>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection
