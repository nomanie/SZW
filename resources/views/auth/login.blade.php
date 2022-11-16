@php($content = true)
@extends('welcome')
@section('content')
        <div class="container mt-5 login">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <img src="{{asset('images/logoSZW.png')}}" height="120">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <form>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center text">
                                Zaloguj się
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <label for="login">Adres e-mail</label>
                                    <input name="email" type="email" class="form-control" placeholder="Adres e-mail">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <label for="password">Hasło</label>
                                    <input name="password" type="password" class="form-control" placeholder="Hasło">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <button class="btn btn-primary" type="submit">Zaloguj się</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-6">
                    <form>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center text">
                                Zarejestruj się
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <label for="email">Adres e-mail</label>
                                    <input name="email" type="email" class="form-control" placeholder="Adres e-mail">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <label for="password">Hasło</label>
                                    <input name="password" type="password" class="form-control" placeholder="Hasło">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <label for="password_confirmation">Potwierdź Hasło</label>
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Potwierdź Hasło">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <button class="btn btn-success" type="submit">Zarejestruj się</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
