@extends('layouts.auth')

@section('content')
    @if($sample)
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">QR Code</h1>
            </div>

            <div class="row">
                You can take a screen shot and save it.  <br />
                <b> Certificate Number: </b> &nbsp;&nbsp;&nbsp; {{ $sample->id }} <br />
                {!! QrCode::size(400)->generate($sample->id) !!}
            </div>

            <hr>
        </div>
    @else
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">No Results Found!</h1>
            </div>

        </div>

    @endif



    <div class="row">
        <a href="/verify" class=" text-center">
            <button class="btn btn-primary">
                Go Back                
            </button>
        </a>        
    </div>

    <

@endsection