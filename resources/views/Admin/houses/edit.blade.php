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
            <li><input type="text" name="address" id="address" value="{{(!empty($house)) ?$house->address : ''}}" placeholder="Inserisci l'indirizzo"></li>
            <li><input type="file" name="img_path" accept="image/*" value="{{(!empty($house)) ?$house->img_path : ''}}">
            <li><select name="status" value="{{(!empty($house)) ?$house->status : ''}}">
                <option value="0">Non pubblicato</option>
                <option value="1">Pubblicato</option>
            </select></li>
            <button type="submit">Modifica</button>
        </form>
    </div>
@endsection