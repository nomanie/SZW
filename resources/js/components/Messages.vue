<template>
    <div class="row h-100">
        <div class="col-lg-2">
            <div class="message__sidebar pt-4">
                <ul>
                    <button class="btn green mb-3">Napisz wiadomość</button>

                    <li class="text-uppercase text-center">Kategorie</li>
                    <li class="message__filter">
                        Odebrane
                    </li>
                    <li class="message__filter">
                        Ważne
                    </li>
                    <li class="message__filter">
                        Wysłane
                    </li>
                    <li class="message__filter">
                        Wersje robocze
                    </li>
                    <li class="message__filter">
                        Zarchiwizowane
                    </li>
                    <li class="message__filter">
                        Kosz
                    </li>
                </ul>
                <hr class="w-75">
                <ul class="text-center filters">
                    <li class="text-uppercase text-center">Szybkie Filtry</li>
                    <li class="badge red">
                        Klienci z Katowic
                    </li>
                    <li class="badge blue">
                        Stali klienci
                    </li>
                    <li class="badge green">
                        Firmy
                    </li>
                    <button class="btn green mt-5">Dodaj Kategorie</button>
                </ul>
            </div>
        </div>
        <div class="col-lg-10 h-100 overflow-hidden">
            <div class="row ps-3 py-2 message__header mt-3">
                <div class="col">
                    <div class="toolbar">
                        <input type="checkbox" class="form-check-input">
                        <i class="fa-solid fa-arrow-rotate-right"></i>
                        <i class="fa-solid fa-envelope-circle-check"></i>
                        <div class="global-search">
                            <div class="input__wrapper">
                                <input type="text" placeholder="Szukaj w poczcie..." id="global-search-input">
                                <span class="underline-animation"></span>
                            </div>
                        </div>
                    </div>
                    <div class="pagination">
                        1-50 z 2550
                        <i class="fa-solid fa-angle-left"></i>
                        <i class="fa-solid fa-angle-right"></i>
                    </div>
                </div>
            </div>
            <div class="row message__container">
                <div class="col overflow-auto h-100 message__table mt-3">
                    <table class="hover w-100 border-row">
                        <tr v-for="i in 25">
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td class="message__table--toolbar">
                                <i class="fa-star" :class="{'fa-solid active': i === 1, 'fa-regular': i !== 1}"></i>
                            </td>
                            <td>
                                Tytuł wiadomości
                            </td>
                            <td class="message__table--toolbar">
                                Trochę treści z tej wiadomości...
                            </td>
                            <td class="message__table--toolbar">
                                <div class="badge" :class="{'blue' : i %3 === 0, 'red': i % 3 === 1, 'green': i % 3 === 2}">
                                    Label
                                </div>
                            </td>
                            <td class="message__table--toolbar">
                                <i class="fa-regular fa-trash-can"></i>
                            </td>
                            <td class="message__table--toolbar">
                                <i class="fa-regular fa-envelope-open"></i>
                            </td>
                            <td class="message__table--toolbar">
                                <i class="fa-solid fa-download"></i>
                            </td>
                            <td class="message__table--toolbar">
                                <i class="fa-solid fa-box-archive"></i>
                            </td>
                            <td class="message__table--toolbar mobile">
                                <div class="dropdown">
                                    <button class="btn-no-style" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa-regular fa-star"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa-regular fa-envelope-open"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="fa-solid fa-box-archive"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Messages',
}
</script>
