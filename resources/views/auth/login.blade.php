@extends('layouts.auth')

@section('content')
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group row">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group row">
                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password"    name="password" required autocomplete="current-password">
                @error('password')
                    <span class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck"    name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                </div>
            </div>
            <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                Login
            </a> -->
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Login
            </button>
            <hr>
            <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Login with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
            </a> -->
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
        <div class="text-center">
            <a class="small" href="{{ route('register') }}">Create an Account!</a>
        </div>
    </div>

@endsection