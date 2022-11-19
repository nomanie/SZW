@php($content = true)
@extends('welcome')
@section('content')
    <div class="container mt-5 login">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Jakie konto chcesz stworzyć</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <a class="col-12 col-lg-3 account-type" href="{{route('register.workshop')}}">
                <img src="{{asset('images/logoSZW.png')}}">
                <div class="account-type__text">
                    Konto dla Warsztatu
                </div>
            </a>
            <a class="col-12 col-lg-3 account-type" href="{{route('register.client')}}">
                <img src="{{asset('images/logoSZW.png')}}">
                <div class="account-type__text">
                    Standardowe konto użytkownika
                </div>
            </a>
            <a class="col-12 col-lg-3 account-type" href="{{route('register.diagnostician')}}">
                <img src="{{asset('images/logoSZW.png')}}">
                <div class="account-type__text">
                    Konto dla stacji diagnostycznej
                </div>
            </a>
        </div>
        <div class="row mt-5 text-center">
            <div class="col-12">
                <h4>Masz już konto?</h4>
            </div>
        </div>
        <div class="row mt-2 text-center">
            <div class="col-12">
                <a href="{{route('login')}}">
                    <button class="btn btn-primary">
                        Zaloguj się
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
