@extends('layouts.layout')
{{-- @extends('layouts.app') --}}

@section('main')

        @foreach ($results as $result)
    <div class="card text-center">
    <div class="card-header">
        {{$result->house_id}}
    </div>
    <div class="card-body">
        <h5 class="card-title">{{$result->email}}</h5>
        <p class="card-text">{{$result->message}}</p>
    </div>
        <div class="card-footer text-muted">
            {{$result->created_at}}
        </div>
    </div>
      @endforeach
@endsection

@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
        @endsection