@extends('layouts.layout')
{{-- @extends('layouts.app') --}}

@section('main')
<div class="container">
<h1>Contatta il proprietario dell'appartamento</h1>

@if(Session::has('success'))
   <div class="alert alert-success">
     {{ Session::get('success') }}
   </div>
@endif

{!! Form::open(['route'=>'contactus.store']) !!}

<input type="text" name="house_id" id="" value="{{$house->id}}">

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
{!! Form::label('La tua Email:') !!}
{!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Inserisci la tua Email']) !!}
<span class="text-danger">{{ $errors->first('email') }}</span>
</div>

<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
{!! Form::label('Messaggio:') !!}
{!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Inserisci il messaggio']) !!}
<span class="text-danger">{{ $errors->first('message') }}</span>
</div>

<div class="form-group">
<button class="btn btn-success">Invia!</button>
</div>

{!! Form::close() !!}

</div>
@endsection
@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
        @endsection