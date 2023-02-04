@extends('admin.layouts.app')

@section('title', 'Post')

@section('content')

    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#editPost', $editPost->post_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" value="{{ old('postTitle', $editPost->title) }}" name="postTitle"
                            class="form-control @error('postTitle') is-invalid @enderror" placeholder="Ender Post Title">
                        @error('postTitle')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror" cols="30"
                            rows="10" placeholder="Ender Description">{{ old('postDescription', $editPost->description) }}</textarea>
                        @error('postDescription')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Image</label>
                        <img class="shadow rounded img-thumbnail"
                            @if ($editPost->image == null) src="{{ asset('defaultImage/default_image.png') }}"
                        @else
                            src="{{ asset('postImage/' . $editPost->image) }}" @endif
                            width="100%">
                        <input type="file" name="postImage" class="form-control mt-1">
                        @error('postImage')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="postCategory" class="form-control @error('postCategory') is-invalid @enderror">
                            <option value="">Choose Category</option>
                            @foreach ($category as $c)
                                <option value="{{ $c->category_id }}" @if ($editPost->category_id == $c->category_id) selected @endif>
                                    {{ $c->title }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>
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
        @if (session('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>{{ session('updateSuccess') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Post Create Page
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
                            <th>Title</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr class="">
                                <td class="">{{ $item->post_id }}</td>
                                <td>{{ $item->title }}</td>

                                <td>
                                    <img @if ($item->image == null) src="{{ asset('defaultImage/default_image.png') }}"
                                    @else src="{{ asset('postImage/' . $item->image) }}" @endif
                                        class="img-thumbnail shadow rounded" width="100px">
                                </td>
                                <td>
                                    <a href="{{ route('admin#postEditPage', $item->post_id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#postDelete', $item->post_id) }}">
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
