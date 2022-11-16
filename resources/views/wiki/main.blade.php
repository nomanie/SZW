@php($content = true)
@extends('welcome')
@section('content')
    <wiki-header img="{{asset('images/person.jpg')}}"></wiki-header>
    <div class="row">
        <div class="col-lg-2">
            @include('wiki.global.sidebar')
        </div>
        <div class="col-lg-10">
            <div class="wiki__content">
                @yield('body')
            </div>
        </div>
    </div>
@endsection
