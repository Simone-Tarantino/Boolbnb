@extends('layouts.layout')
@extends('layouts.app')
@section('main')
    <h2>Numero appartamento {{$house->id}}, pubblicato da {{$house->user_id}}</h2>
        <ul>
            <li>Numero stanze:{{$house->room_number}}</li>
            <li>Numero letti:{{$house->bed}}</li>
            <li>Numero bagni:{{$house->bathroom}}</li>
            <li>Metri Quadri Appartamento: {{$house->mq}}</li>
            <li class="address">Indirizzo: {{$house->address}}</li>
            <li>Foto: {{$house->img_path}}</li>
            <li>Caricato il: {{$house->created_at}}</li>
            <li>Modificato il: {{$house->updated_at}}</li>
            <div class='coord-lat' value="{{$house->latitude}}">{{$house->latitude}}</div>
            <div class='coord-lon' value="{{$house->longitude}}">{{$house->longitude}}</div>
            @if ($house->status == 1)
            <li>Pubblicato: Si</li> 
            @else 
               <li>Pubblicato: no</li>
            @endif
            @if($house->user_id == Auth::user()->id)
            <li><a href="{{route('admin.houses.edit', $house)}}">Modifica dati</a></li>
            @endif
        </ul>
        <ul>
        <li><h3>Servizi extra</h3></li>
        @foreach ($house->extras as $extra)
        <li>{{$extra->name}}</li>
            
        @endforeach
        </ul>
        {{-- <h3>Lascia un messaggio</h3>
        <form action="" method="POST">
         @csrf
         @method('POST')
         <div class="form-group">
         <input class="hidden" type="hidden" name="" value="{{$house->id}}">
         </div>
        <label for="email">La tua Mail</label>
         <div class="form-group">
        <input name='email' type="email" placeholder="inserisci mail">
         </div>
         <label for="messaggio">il tuo messaggio</label>
         <div class="form-group">
     <textarea name='messaggio' rows="4" cols="50" form="usrform" placeholder="inserisci messaggio">
     </textarea>  
         </div>
<button type="submit" class="btn btn-primary">Invia</button>
        </form> --}}
        <div id="map" ></div>
        </div>
        @endsection
        
        @section('scripts')
            
            <script src="{{asset('js/map.js')}}"></script>
        @endsection