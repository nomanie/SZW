<template>
    <div class="sidebar">
        <div class="logo">
            <router-link :to="{name: 'workshop.dashboard'}">
                <div class="img">
                    <img src="/images/logoSZW.png" width="50">
                </div>
                <div class="text">
                    System Zarządzania Warsztatem
                </div>
            </router-link>
        </div>
        <div class="sidebar__list sidebar__list--mobile">

        </div>
        <div class="sidebar__list">
            <ul>
                <li class="sidebar__list--item active">
                    <router-link :to="{name: 'workshop.dashboard'}">
                        <div>
                            <i class="fa-solid fa-house"></i>
                            <p>
                                Strona główna
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link :to="{name: 'workshop.clients'}">
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
                    <router-link :to="{name: 'workshop.documents'}">
                        <div>
                            <i class="fa-solid fa-file-lines"></i>
                            <p>
                                Dokumenty
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link :to="{name: 'workshop.repairs'}">
                        <div>
                            <i class="fa-solid fa-wrench"></i>
                            <p>
                                Naprawy
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link :to="{name: 'workshop.messages'}">
                        <div>
                            <i class="fa-solid fa-envelope"></i>
                            <p>
                                Wiadomości
                            </p>
                        </div>
                    </router-link>
                </li>
                <li class="sidebar__list--item">
                    <router-link :to="{name: 'workshop.calendar'}">
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
                    <router-link :to="{name: 'workshop.support'}">
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
}
</script>
