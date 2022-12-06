@php($content = true)
@extends('welcome')
@section('content')
    <login img="{{asset('images/logoSZW.png')}}" :verified="@json(isset($verified))"></login>
@endsection
