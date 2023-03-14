@extends('layouts.app')

@section('content')
    <div class="form  p-5 card" style="width: 100%">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-4">
                <div class="form-outline ">
                    <input type="text" id="form1Example3" name="name" class="form-control" autofocus autocomplete="name"
                        value="{{ old('name') }}" />
                    <label class="form-label" for="form1Example3">Name</label>
                </div>
                @error('name')
                    <div class="error">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <div class="form-outline ">
                    <input type="email" id="form1Example1" name="email" class="form-control"
                        value="{{ old('email') }}" />
                    <label class="form-label" for="form1Example1">Email address</label>
                </div>
                @error('email')
                    <div class="error">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <div class="form-outline ">
                    <input type="password" id="form1Example2" name="password" class="form-control" />
                    <label class="form-label" for="form1Example2">Password</label>
                </div>
                @error('password')
                    <div class="error">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <div class="form-outline ">
                    <input type="password" id="form1Example2" name="password_confirmation" class="form-control" />
                    <label class="form-label" for="form1Example2">Confirm Password</label>
                </div>
                @error('password_confirmation')
                    <div class="error">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign up</button>
        </form>
        <a class="text-primary mt-3" href="{{ route('login@Page') }}">Sign in here</a>
    </div>
@endsection
