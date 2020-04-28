@extends('layouts.layout')
{{-- @extends('layouts.app') --}}
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
    <div class="edit-post">
        <form action="{{route('admin.houses.update', $house)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <li><input type="number" id="room_number" name="room_number"
            min="1" max="5" value="{{(!empty($house)) ?$house->room_number : ''}}" placeholder="Inserisci numero di stanze"></li>
            <li><input type="number" id="bed" name="bed"
            min="1" max="10" value="{{(!empty($house)) ?$house->bed : ''}}" placeholder="Inserisci numero di letti"></li>
            <li><input type="number" id="bathroom" name="bathroom"
            min="1" max="5" value="{{(!empty($house)) ?$house->bathroom : ''}}" placeholder="Inserisci numero di bagni"></li>
            <li><input type="number" id="mq" name="mq" step="any" min="50" max="900" value="{{(!empty($house)) ?$house->mq : ''}}" placeholder="Inserisci il n. di mq"></li>
<<<<<<< HEAD
            <li><input type="text"  name="description" value="{{(!empty($house)) ?$house->description : ''}}" placeholder="Descrizione"></li>
            <li><input type="text" class="address-input" name="address" value="{{(!empty($house)) ?$house->address : ''}}" placeholder="Cerca l'indirizzo"></li>
=======
            <li><input type="text" class="address-input" name="address" placeholder="Cerca l'indirizzo"></li>
>>>>>>> master
            <button class="search" type="submit">Cerca</button>
        <div class="results">

        </div>

        <li><input id="address-up" type="text" class='indirizzo' name="address" id="address" value="{{(!empty($house)) ?$house->address : ''}}" readonly placeholder="Indirizzo"></li>
        <li><input id="address-lat-up" type="text"  name="latitude" id="" value="{{(!empty($house)) ? $house->latitude : ''}}" readonly placeholder="latitudine"></li>
        <li><input id="address-long-up" type="text" name="longitude" id="" value="{{(!empty($house)) ? $house->longitude : ''}}" readonly placeholder="longitudine"></li>
            <li><input type="file" name="img_path" accept="image/*" value="{{(!empty($house)) ?$house->img_path : ''}}">
            <li><select name="status" value="{{(!empty($house)) ?$house->status : ''}}">
                <option value="0">Non pubblicato</option>
                <option value="1">Pubblicato</option>
            </select></li>

            <div class="form-group">
          <label for="extras">extras</label>
          @foreach ($extras as $extra)
          <div>
            <span>{{$extra->name}}</span>
            <input type="checkbox" name="extras[]" value="{{$extra->id}}" {{($house->extras->contains($extra->id)) ? 'checked' : ''}}>
          </div>
          @endforeach
        </div>
            <button type="submit">Modifica</button>
        </form>
    </div>

     <script id="entry-template" type="text/x-handlebars-template">
            <div class="entry-result">
                <div class="indirizzo">
                    <p>@{{address}}</p>
                    <ul class="coord">
                        <input class="lat" type="text" value="@{{latitude}}" name="" id="" readonly>
                        <input class="long" type="text" value="@{{longitude}}" name="" id="" readonly>
                    </ul>
                </div>
            </div>
        </script>

@endsection
@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
        @endsection