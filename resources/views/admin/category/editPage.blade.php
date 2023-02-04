@extends('admin.layouts.app')

@section('title', 'Category Edit Page')

@section('content')
    <div class="col-8 offset-2">

        <div class="card">
            <h4 class="text-center mt-3">Category Edit Page</h4>
            <div class="card-body">
                <form action="{{ route('category#edit', $category->category_id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{ old('categoryName', $category->title) }}" name="categoryName"
                            class="form-control @error('categoryName') is-invalid @enderror">
                        @error('categoryName')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="categoryDescription" class="form-control @error('categoryDescription') is-invalid @enderror"
                            cols="30" rows="10">{{ old('categoryDescription', $category->description) }}</textarea>
                        @error('categoryDescription')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>


@endsection
