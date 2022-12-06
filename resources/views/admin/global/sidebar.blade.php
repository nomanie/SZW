@php($route = Route::current()->getName())
@php($segment = explode('.', $route)[1])
<div class="admin-sidebar">
    <div class="logo">
        SZW Admin Logo
    </div>
    <ul class="nav">
        <li class="nav-item @if($route === 'admin.dashboard') active @endif">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="fa fa-home"></i>
                Strona główna
            </a>
        </li>
        <li class="nav-item @if($segment === 'cars') active @endif">
            <div class="dropdown">
                <div class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-car"></i>
                        Samochody
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-field @if($route === 'admin.cars.brands.index') active @endif" href="{{route('admin.cars.brands.index')}}">Marki</a>
                    <a class="dropdown-field @if($route === 'admin.cars.models.list') active @endif" href="{{route('admin.cars.models.list')}}">Modele</a>
                    <a class="dropdown-field @if($route === 'admin.cars.series.list') active @endif" href="{{route('admin.cars.series.list')}}">Serie</a>
                    <a class="dropdown-field @if($route === 'admin.cars.generations.list') active @endif" href="{{route('admin.cars.generations.list')}}">Generacje</a>
                    <a class="dropdown-field @if($route === 'admin.cars.engines.list') active @endif" href="{{route('admin.cars.engines.list')}}">Silniki</a>
                    <a class="dropdown-field @if($route === 'admin.cars.types.list') active @endif" href="{{route('admin.cars.types.list')}}">Typy</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="dropdown">
                <div class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-wrench"></i>
                    Warsztaty
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-field" href="#">Lista</a>
                    <a class="dropdown-field" href="#">Dodaj</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="dropdown">
                <div class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-users"></i>
                    Klienci
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-field" href="#">Lista</a>
                    <a class="dropdown-field" href="#">Dodaj</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="dropdown">
                <div class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs"></i>
                    Ustawienia
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-field" href="#">Konta</a>
                    <a class="dropdown-field" href="#">Permisje</a>
                </div>
            </div>
        </li>
    </ul>
    <div class="footer">
        <i class="fa fa-envelope"></i>
        <i class="fa fa-bell"></i>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="btn-no-style text-white">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    </div>
</div>
