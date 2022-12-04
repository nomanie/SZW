@php($content = true)
@extends('welcome')
@section('content')
    <login img="{{asset('images/logoSZW.png')}}" verified="{{isset($verified) ?? (bool)$verified}}"></login>
@endsection
