<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <script src="https://kit.fontawesome.com/6e38d77999.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
    </head>
    <body class="antialiased">
       <div id="app">
           <div class="row h-100vh">
               <div class="sidebar__container">
                   <sidebar></sidebar>
               </div>
               <div class="col" style="width: calc(100% - 100px)">
                   <div class="row">
                       <div class="col">
                            <header-nav></header-nav>
                       </div>
                   </div>
                   <div class="row h-without-header">
                       <div class="col h-100">
{{--                            <dashboard></dashboard>--}}
{{--                           <support></support>--}}
{{--                           <clients></clients>--}}
{{--                           <cars></cars>--}}
{{--                           <documents></documents>--}}
{{--                           <repairs></repairs>--}}
                           <messages></messages>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </body>
    <script src="{{mix('js/app.js')}}"></script>
</html>
