@extends('layouts.layout')
{{-- @extends('layouts.app') --}}

@section('main')
<div class="container contact_us main">
<h1 class="primary mt-4 mb-4">Contatta il proprietario dell'appartamento</h1>
@if(Session::has('success'))
   <div class="alert alert-success">
     {{ Session::get('success') }}
   </div>
@endif

{!! Form::open(['route'=>'contactus.store']) !!}

<input class="d-none" type="text" name="house_id" id="" value="{{$house->id}}">
<div class="form-group">
  {!! Form::label('Appartamento:') !!}
  <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$house->address}}">
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
<label for="userEmail">La tua Email:</label>
<input name="email" type="email" class="form-control" id="userEmail" placeholder="Inserisci la tua Email" value="{{((Auth::check())) ? (Auth::user()->email) : ''}}">
<span class="text-danger">{{ $errors->first('email') }}</span>
</div>

<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
{!! Form::label('Messaggio:') !!}
{!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Inserisci il messaggio']) !!}
<span class="text-danger">{{ $errors->first('message') }}</span>
</div>

<div class="form-group">
<button class="btn btn-send">Invia</button>
</div>

{!! Form::close() !!}

</div>
@endsection
@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
        @endsection