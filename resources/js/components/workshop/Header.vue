<template>
    <div class="header pt-2 pb-2">
        <div class="header__left">
            <div>
                Klienci
            </div>
        </div>
        <div class="header__right">
            <div class="global-search">
                <div class="input__wrapper">
                    <input type="text" placeholder="Wyszukaj..." id="global-search-input">
                    <span class="underline-animation"></span>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="flags">
                <div class="dropdown">
                    <button class="btn-no-style" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../public/images/flags/poland.svg" height="20">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="#">
                                <img src="../../../../public/images/flags/uk.svg" height="20">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="notifications">
                <div class="dropdown">
                    <button class="btn-no-style d-flex" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-bell"></i>
                        <div class="counter">
                            3
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <notification-list></notification-list>
                    </ul>
                </div>

            </div>
            <div class="messages">
                <i class="fa-regular fa-envelope"></i>
                <div class="counter">
                    +9
                </div>
            </div>
            <div class="profile">
                <div class="dropdown">
                    <button class="btn-no-style" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../public/images/person.jpg" width="50">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <li class="text-center">
                            Piotr Skwarek
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-regular fa-id-card"></i>
                                <span>Informacje</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-cogs"></i>
                                <span>Ustawienia</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-users"></i>
                                <span>Użytkownicy</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-bug"></i>
                                <span>Zgłoś błąd</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-door-open"></i>
                                <span>Wyloguj</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import NotificationList from "../NotificationList";
export default {
    name: 'HeaderNav',
    components: {NotificationList}
}
</script>
