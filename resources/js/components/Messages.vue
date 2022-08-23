<template>
    <div class="row h-100">
        <div class="col-lg-2">
            <div class="message__sidebar pt-4">
                <ul>
                    <button class="btn green mb-3">Napisz wiadomość</button>

                    <li class="text-uppercase text-center">Kategorie</li>
                    <li>
                        Odebrane
                    </li>
                    <li>
                        Ważne
                    </li>
                    <li>
                        Wysłane
                    </li>
                    <li>
                        Wersje robocze
                    </li>
                    <li>
                        Zarchiwizowane
                    </li>
                    <li>
                        Kosz
                    </li>
                </ul>
                <hr class="w-75">
                <ul class="text-center">
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
            <div class="row ps-3 py-2 message__header">
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
            <div class="row h-100">
                <div class="col overflow-auto h-100">
                    <table class="message__table hover striped">
                        <tr v-for="i in 25">
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <i class="fa-regular fa-star"></i>
                            </td>
                            <td>
                                Tytuł wiadomości
                            </td>
                            <td>
                                Trochę treści z tej wiadomości...
                            </td>
                            <td>
                                <i class="fa-regular fa-trash-can"></i>
                            </td>
                            <td>
                                <i class="fa-regular fa-envelope-open"></i>
                            </td>
                            <td>
                                <i class="fa-solid fa-download"></i>
                            </td>
                            <td>
                                <i class="fa-solid fa-box-archive"></i>
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
