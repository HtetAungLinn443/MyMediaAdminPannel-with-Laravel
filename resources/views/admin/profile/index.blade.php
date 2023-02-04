@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')

    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert Start --}}
                            @if (session('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span>{{ session('updateSuccess') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="form-horizontal" action="{{ route('admin#update', Auth::user()->id) }}"
                                method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="adminName" class="form-control" id="inputName"
                                            value="{{ old('adminName', Auth::user()->name) }}" placeholder="Enter Name ...">
                                        @error('adminName')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="adminEmail" class="form-control" id="inputEmail"
                                            value="{{ old('adminEmail', Auth::user()->email) }}"
                                            placeholder="Enter Email ...">
                                        @error('adminEmail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="adminPhone" class="form-control" id="inputPhone"
                                            value="{{ old('adminPhone', Auth::user()->phone) }}"
                                            placeholder="Enter Phone ...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="adminAddress" id="address" placeholder="Enter Address ..." cols="30"
                                            rows="10">{{ old('adminAddress', Auth::user()->address) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="adminGender" class="form-control" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Submit</button>
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
