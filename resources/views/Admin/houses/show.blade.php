@extends('layouts.layout')
@extends('layouts.app')
@section('main')
    <h2>Numero appartamento {{$house->id}}, pubblicato da {{$house->user_id}}</h2>
        <ul>
            <li>Numero stanze:{{$house->room_number}}</li>
            <li>Numero letti:{{$house->bed}}</li>
            <li>Numero bagni:{{$house->bathroom}}</li>
            <li>Metri Quadri Appartamento: {{$house->mq}}</li>
            <li>Indirizzo: {{$house->address}}</li>
            <li>Foto: {{$house->img_path}}</li>
            <li>Caricato il: {{$house->created_at}}</li>
            <li>Modificato il: {{$house->updated_at}}</li>
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
          <div id='map'>

        </div>
        <script>

            // Definisco una variabile con le cordinate di longitudine e latitudine dell'appartamento
            var cordinateAppartamento = [-121.91595, 37.36729];
            var map = tt.map({
                container: 'map',
                key: 'jmSHc4P5sMLTeiGeWWoRL81YcCxYxqGp',
                style: 'tomtom://vector/1/basic-main',
                center: cordinateAppartamento,
                zoom: 15
            });
            //Aggiungo un punto d'interesse all'interno della mappa
            var marker = new tt.Marker().setLngLat(cordinateAppartamento).addTo(map);

            //Aggiungo un pop up all'interno della mappa
            var popupOffsets = {
              top: [0, 0],
              bottom: [0, -70],
              'bottom-right': [0, -70],
              'bottom-left': [0, -70],
              left: [25, -35],
              right: [-25, -35]
            }
            //Aggiungo le informazioni del nostro appartamento
            var popup = new tt.Popup({offset: popupOffsets}).setHTML("<b>Il nostro Appartamento</b><br/>100 Century Center Ct 210, San Jose, CA 95112, USA");
            marker.setPopup(popup).togglePopup();


						$(document).ready(function() {
            //Chiamata ajax
							$.ajax(
								 {
								 url: "https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT&municipality=Milano&key=jmSHc4P5sMLTeiGeWWoRL81YcCxYxqGp",
								 method: "GET",
								 success: function (data, stato) {
									 // console.log(data);
								 // $("#risultati").html(data);
								 processData(data.results);
								 },
								 error: function (richiesta, stato, errori) {
								 alert("E' avvenuto un errore. " + errore);
								 }
								 }
								);
						});

						function processData (data) {
							console.log(data);
						}
        </script>
@endsection