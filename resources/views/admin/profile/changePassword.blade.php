@extends('admin.layouts.app')

@section('title', 'Password Change')

@section('content')

    <div class="col-8 offset-2 mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Password Change Page</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert Start --}}
                            @if (session('fill'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span>{{ session('fill') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="form-horizontal" action="{{ route('admin#changePassword') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">Old Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="oldPassword" class="form-control" id="inputName"
                                            placeholder="Enter Old Password ...">
                                        @error('oldPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPass" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="newPassword" class="form-control" id="newPass"
                                            placeholder="Enter New Password ...">
                                        @error('newPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="conPass" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="confirmPassword" class="form-control" id="conPass"
                                            placeholder="Enter Confirm Password ...">
                                        @error('confirmPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-5 col-sm-7">
                                        <button type="submit" class="btn bg-dark text-white">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
