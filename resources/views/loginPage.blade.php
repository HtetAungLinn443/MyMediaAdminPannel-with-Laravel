@extends('layouts.app')

@section('content')
    <div class="form  p-5 card" style="width: 100%">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <div class="form-outline ">
                    <input type="email" id="form1Example1" name="email" class="form-control" autocomplete="email" autofocus
                        value="{{ old('email') }}" />
                    <label class="form-label" for="form1Example1">Email address</label>
                </div>
                @error('email')
                    <div class="error text-danger">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <div class="form-outline mb-4">
                    <input type="password" id="form1Example2" name="password" class="form-control" />
                    <label class="form-label" for="form1Example2">Password</label>
                </div>
                @error('password')
                    <div class="error text-danger">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>
        <a class="text-primary mt-3" href="{{ route('register@Page') }}">Sign up here</a>
    </div>
@endsection
