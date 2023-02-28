<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @routes
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6e38d77999.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{mix('css/main.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        header {
            padding: 0.5rem 0;
            background: rgb(218, 218, 218);
        }

        header .navbar .navbar-nav .nav-link {
            margin: 0 .5rem;
            padding: .5rem;
            font-size: 1rem;
            font-weight: 500;
            transition: all .3s ease
        }

        header .navbar .navbar-nav .nav-link:hover {
            color: orange !important;
        }

        @media (min-width: 992px) {
            header .navbar.navbar-centered .navbar-brand {
                position: absolute;
                left: 0;
                width: 100%;
                margin: 0;
                display: flex;
                justify-content: center
            }

            header .navbar.navbar-centered .navbar-right {
                z-index: 1;
                width: 50%;
                margin-left: 5rem;
                display: flex;
                justify-content: start;
                align-items: center
            }

            header .navbar.navbar-centered .navbar-left {
                z-index: 1;
                width: 50%;
                margin-right: 5rem;
                display: flex;
                justify-content: end;
                align-items: center
            }
        }

        @media (max-width: 991px) {
            header .container {
                max-width: 960px !important;
                padding-left: 1rem;
                padding-right: 1rem
            }

            header .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem
            }

            header .navbar .navbar-toggler {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 0;
                border: none
            }
        }
    </style>
</head>
<body class="antialiased">
<div>
    <header id="header">
        <nav id="navbar" class="navbar navbar-centered navbar-expand-lg" style="top: 0;">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="fa fa-css3"></i>
                </a>
                <button class="navbar-toggler" data-bs-target="#navbar-items" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                </button>
                <div id="navbar-items" class="collapse navbar-collapse">
                    <div class="navbar-collapse-form">
                        <div class="d-only-mobile d-none">
                        </div>
                    </div>
                    <div class="navbar-left">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#demos" class="nav-link">
                                    Demos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#features" class="nav-link">
                                    Features
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#pages" class="nav-link">
                                    Pages
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-right">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#portfolio" class="nav-link">
                                    Portfolio
                                </a></li>
                            <li class="nav-item">
                                <a href="#elements" class="nav-link">
                                    Elements
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" target="_blank" class="nav-link">
                                    Buy Shock
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</div>
</body>
<script src="{{mix('js/app.js')}}"></script>
@stack('scripts')
</html>
