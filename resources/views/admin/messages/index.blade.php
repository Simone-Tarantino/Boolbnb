@extends('layouts.layout')


@section('main')
  <div class="container inbox_messages">
<h2 class="mt-4 mb-4 text-center title">I Tuoi Messaggi</h2>
  @foreach ($results as $result)
  <div class="card mt-3">
  <div class="card-header">
   Appartamento <a href="{{route('admin.houses.show', $result->house_id)}}">{{$result->address}}</a>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>{{$result->message}}</p>
      <footer class="blockquote-footer">Inviato da <cite class="sender">{{$result->email}}</cite> il <span class="date">{{$result->created_at}}</span></footer>
    </blockquote>
  </div>
</div>
@endforeach
</div>

@endsection



@section('scripts')
            
            <script src="{{asset('js/app.js')}}"></script>
        @endsection