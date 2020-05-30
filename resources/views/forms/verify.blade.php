@extends('layouts.auth')

@section('content')
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Please input your details!</h1>
        </div>
        <form class="user" method="POST" action="/verify">
            @csrf
            <div class="form-group row">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Identifier..." name="identifier" value="{{ old('identifier') }}" required autocomplete="identifier" autofocus>
                @error('identifier')
                    <span class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary btn-user btn-block">
                Login
            </button>
        </form>
        <hr>
    </div>

@endsection