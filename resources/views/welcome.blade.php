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
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body class="antialiased">
       <div id="app" class="overflow-hidden">
           @if (isset($content))
               @yield('content')
           @else
               <div class="row h-100vh">
                   <div class="sidebar__container">
                       <sidebar></sidebar>
                   </div>
                   <div class="content">
                        <header-nav name="{{auth()->user()->email}}"></header-nav>
                        <div class="pager">
                            <router-view></router-view>
                        </div>
                   </div>
               </div>
           @endif
       </div>
    </body>
    <script src="{{mix('js/app.js')}}"></script>
    @stack('scripts')
</html>
