@extends('admin.layouts.app')

@section('title', 'Trend Post')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <button class="btn btn-sm btn-outline-dark">Trend Post Page</button>
                </h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Image</th>
                            <th>View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $item->post_id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <img @if ($item->image == null) src="{{ asset('defaultImage/default_image.png') }}"
                                    @else src="{{ asset('postImage/' . $item->image) }}" @endif
                                        class="img-thumbnail shadow rounded" width="100px">
                                </td>
                                <td><i class="fa-solid fa-eye mr-2"></i>{{ $item->post_count }}</td>

                                <td>
                                    <a href="{{ route('admin#trendPostDetails', $item->post_id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i
                                                class="fa-solid fa-file-lines"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {{-- <div class="d-flex justify-content-end mr-5">{{ $post->links() }}</div> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection
