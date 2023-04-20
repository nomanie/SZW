@php($content = true)
@extends('welcome')
@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Wprowadź pin aby się zalogować</h2>
            </div>
        </div>
        <form method="post" action="{{route('insert_pin.post')}}">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-12">
                    <input class="form-control mb-2 mt-4 w-100" type="text" name="pin" placeholder="Wpisz pin">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12 mt-2">
                    <button class="btn btn-primary w-100" type="submit">Zaloguj</button>
                </div>
            </div>
        </form>
    </div>
@endsection

