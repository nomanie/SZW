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
                <b-dropdown class="m-md-2" no-caret offset="5">
                    <template #button-content>
                        <button class="btn-no-style" type="button">
                            <img src="../../../../public/images/flags/poland.svg" height="20">
                        </button>
                    </template>
                    <b-dropdown-item>
                        <a class="dropdown-item" href="#">
                            <img src="../../../../public/images/flags/uk.svg" height="20">
                        </a>
                    </b-dropdown-item>
                </b-dropdown>

            </div>
            <div class="notifications">
                <b-dropdown class="m-md-2" no-caret>
                    <template #button-content>
                        <button class="btn-no-style d-flex" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell"></i>
                            <div class="counter">
                                3
                            </div>
                        </button>
                    </template>
                    <notification-list></notification-list>
                </b-dropdown>
            </div>
            <div class="messages">
                <i class="fa-regular fa-envelope"></i>
                <div class="counter">
                    +9
                </div>
            </div>
            <div class="profile">

                <b-dropdown class="m-md-2" no-caret offset="-130">
                    <template #button-content>
                        <button class="btn-no-style" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <img src="../../../../public/images/person.jpg" width="50">
                        </button>
                    </template>
                    <b-dropdown-item>
                        Piotr Skwarek
                    </b-dropdown-item>
                    <b-dropdown-divider></b-dropdown-divider>
                    <b-dropdown-item>
                        <i class="fa-regular fa-id-card"></i>
                        <router-link to="/informations">
                            <span>Informacje</span>
                        </router-link>
                    </b-dropdown-item>
                    <b-dropdown-item>
                        <i class="fa-solid fa-cogs"></i>
                        <router-link to="/settings">
                            <span>Ustawienia</span>
                        </router-link>
                    </b-dropdown-item>
                    <b-dropdown-item>
                        <i class="fa-solid fa-users"></i>
                        <router-link to="/workers">
                            <span>Użytkownicy</span>
                        </router-link>
                    </b-dropdown-item>
                    <b-dropdown-item>
                        <i class="fa-solid fa-bug"></i>
                        <router-link to="/error-report">
                            <span>Zgłoś błąd</span>
                        </router-link>
                    </b-dropdown-item>
                    <b-dropdown-item>
                        <i class="fa-solid fa-door-open"></i>
                        <span>Wyloguj</span>
                    </b-dropdown-item>
                </b-dropdown>
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
