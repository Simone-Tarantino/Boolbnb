@extends('layouts.layout')
@extends('layouts.app')

@section('main')
    @dd($result);
    {{$result->message}}
@endsection