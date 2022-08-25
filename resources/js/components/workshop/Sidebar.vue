<template>
    <div class="sidebar">
        <div class="logo">
            <a>
                <div class="img">
                    <img src="../../../../public/images/logoSZW.png" width="75">
                </div>
                <div class="text">
                    System Zarządzania Warsztatem
                </div>
            </a>
        </div>
        <div class="sidebar__list sidebar__list--mobile">

        </div>
        <div class="sidebar__list">
            <ul>
                <li class="sidebar__list--item active">
                    <router-link to="/dashboard">
                        <div>
                            <i class="fa-solid fa-house"></i>
                            <p>
                                Strona główna
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link to="/clients">
                        <div>
                            <i class="fa-solid fa-users"></i>
                            <p>
                                Klienci
                            </p>
                        </div>
                    </router-link>
                </li>
<!--                <li class="sidebar__list&#45;&#45;item">-->
<!--                    <a>-->
<!--                        <div>-->
<!--                            <i class="fa-solid fa-car"></i>-->
<!--                            <p>-->
<!--                                Pojazdy-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </li>-->
                <li class="sidebar__list--item">
                    <router-link to="/documents">
                        <div>
                            <i class="fa-solid fa-file-lines"></i>
                            <p>
                                Dokumenty
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link to="/repairs">
                        <div>
                            <i class="fa-solid fa-wrench"></i>
                            <p>
                                Naprawy
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link to="/messages">
                        <div>
                            <i class="fa-solid fa-envelope"></i>
                            <p>
                                Wiadomości
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link to="/calendar">
                        <div>
                            <i class="fa-solid fa-calendar"></i>
                            <p>
                                Kalendarz
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <a>
                        <div>
                            <i class="fa-solid fa-basket-shopping"></i>
                            <p>
                                Zamówienia
                            </p>
                        </div>
                    </a>
                </li>
                <li class="sidebar__list--item">
                    <a>
                        <div>
                            <i class="fa-solid fa-barcode"></i>
                            <p>
                                Skanuj tablice
                            </p>
                        </div>
                    </a>
                </li>
                <li class="sidebar__list--item">
                    <router-link to="/support">
                        <div>
                            <i class="fa-solid fa-info-circle"></i>
                            <p>
                                Wsparcie
                            </p>
                        </div>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    data() {
        return {
            links: {
                dashboard: route('dashboard'),
                clients: route('clients'),
                documents: route('documents'),
                repairs: route('repairs'),
                messages: route('messages'),
                calendar: route('calendar'),
                support: route('support')
            }
        }
    },
    methods: {
        change(){
            document.querySelector('div#content').innerHTML = 'test'
        }
    }

}
</script>
