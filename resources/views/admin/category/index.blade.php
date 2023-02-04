@extends('admin.layouts.app')

@section('title', 'Category')

@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#categoryCreate') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{ old('categoryName') }}" name="categoryName" id=""
                            class="form-control @error('categoryName') is-invalid @enderror"
                            placeholder="Ender Category Name">
                        @error('categoryName')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="categoryDescription" class="form-control @error('categoryDescription') is-invalid @enderror"
                            cols="30" rows="10" placeholder="Ender Description">{{ old('categoryDescription') }}</textarea>
                        @error('categoryDescription')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        @if (session('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span>{{ session('deleteSuccess') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Category Create Page
                </h3>

                <div class="card-tools">
                    <form action="{{ route('admin#categorySearch') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="categoryKey" class="form-control float-right" placeholder="Search">

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
                            <th>Category Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $c)
                            <tr>
                                <td>{{ $c->category_id }}</td>
                                <td>{{ $c->title }}</td>
                                <td>{{ $c->description }}</td>
                                <td>
                                    <a href="{{ route('category#editPage', $c->category_id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#categoryDelete', $c->category_id) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
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
