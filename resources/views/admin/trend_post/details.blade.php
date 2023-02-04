@extends('admin.layouts.app')

@section('title', 'Trend Post Details')

@section('content')

    <div class="col-6 offset-3 mt-5">
        <a href="{{ route('admin#trendPost') }}">
            <i class="fa-solid fa-arrow-left my-3 text-dark"></i>
        </a>
        <div class="card">
            <div class="card-header">
                <div class="text-center my-3">
                    <img @if ($data->image == null) src="{{ asset('defaultImage/default_image.png') }}"
                                    @else src="{{ asset('postImage/' . $data->image) }}" @endif
                        class="img-thumbnail shadow rounded" style="width:400px">
                </div>
            </div>
            <div class="card-body">
                <h2 class="text-center text-primary my-3 text-capitalize">{{ $data->title }}</h2>
                <p>{{ $data->description }}</p>
            </div>
        </div>
    </div>


@endsection
