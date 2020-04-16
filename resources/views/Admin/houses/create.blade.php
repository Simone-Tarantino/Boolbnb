{{-- @dd($extras); --}}

@extends('layouts.layout')
@extends('layouts.app')

@section('main')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route('admin.houses.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <li><input type="number" id="room_number" name="room_number"
        min="1" max="5" placeholder="Inserisci numero di stanze"></li>
        <li><input type="number" id="bed" name="bed"
        min="1" max="10" placeholder="Inserisci numero di letti"></li>
        <li><input type="number" id="bathroom" name="bathroom"
        min="1" max="5" placeholder="Inserisci numero di bagni"></li>
        <li><input type="number" id="mq" name="mq" step="any" min="50" max="900" placeholder="Inserisci il n. di mq"></li>
        <li><input type="text" name="address" id="address" placeholder="Inserisci l'indirizzo"></li>
        <li><input type="file" name="img_path" accept="image/*">
        <li><select name="status">
            <option value="0">Non pubblicato</option>
            <option value="1">Pubblicato</option>
        </select></li>

        <div class="form-group">
          <label for="extras">extras</label>
          @foreach ($extras as $extra)
          <div>
            <span>{{$extra->name}}</span>
            <input type="checkbox" name="extras[]" value="{{$extra->id}}">
          </div>
          @endforeach
        </div>
        
        <button type="submit">Crea</button>
    </form>
@endsection