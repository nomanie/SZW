<template>
    <div class="mt-5 settings">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card settings__view">
                    <div class="card-header mb-3">
                        <div class="table__top orange">
                            <h5>
                                Ustawienia Wyglądu
                            </h5>
                            <span>
                                Pozwala na zmianę wyglądu panelu
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h4>Kolory Kart</h4>
                            <hr>
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 1</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 1</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 1</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 1</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                        </div>
                        <h4 class="mt-4">Kolory nawigacyjne</h4>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 col-centered">
                                <label for="">Kolor Bocznego menu</label>
                                <input type="color">
                            </div>
                            <div class="col-12 col-md-6 col-centered">
                                <label for="">Kolor Górnego menu</label>
                                <input type="color">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-6 col-lg-3">
                                <button class="btn green w-100">Zapisz</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card settings__view">
                    <div class="card-header mb-3">
                        <div class="table__top blue">
                            <h5>
                                Ustawienia Danych
                            </h5>
                            <span>
                                Zmiana hasła oraz adresu e-mail
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs ps-3" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Zmiana hasła
                                </button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Zmiana adresu e-mail
                                </button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                 aria-labelledby="nav-home-tab">
                                <form class="mt-4">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-12 col-md-4">
                                            <label for="">Stare Hasło</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3 justify-content-center">
                                        <div class="col-12 col-md-4">
                                            <label for="">Nowe hasło</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3 justify-content-center">
                                        <div class="col-12 col-md-4">
                                            <label for="">Powtórz hasło</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="password" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                 aria-labelledby="nav-profile-tab">
                                <form class="mt-4">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-6">
                                            <label for="">Stary adres e-mail</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-12 col-md-6">
                                            <label for="">Nowy adres E-mail</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-6 col-lg-3">
                                <button class="btn green w-100">Zapisz</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">

            <div class="col-12 col-md-4">
                <div class="card settings__view">
                    <div class="card-header mb-3">
                        <div class="table__top lime">
                            <h5>
                                Ustawienia Powiadomień w panelu
                            </h5>
                            <span>
                                Pozwala dostosować typy powiadomień, które mają być wysyłane
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="mt-4 ms-3">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    Ukończenie zlecenia
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-6 col-lg-3">
                                <button class="btn green w-100">Zapisz</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card settings__view">
                    <div class="card-header mb-3">
                        <div class="table__top yellow">
                            <h5>
                                Ustawienia Powiadomień E-mail
                            </h5>
                            <span>
                                Pozwala dostosować typy powiadomień, które mają być wysyłane
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="mt-4 ms-3">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    Ukończenie zlecenia
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-6 col-lg-3">
                                <button class="btn green w-100">Zapisz</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card settings__view">
                    <div class="card-header mb-3">
                        <div class="table__top purple">
                            <h5>
                                Ustawienia Powiadomień SMS
                            </h5>
                            <span>
                                Pozwala dostosować typy powiadomień, które mają być wysyłane
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="mt-4 ms-3">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    Ukończenie zlecenia
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-12 col-md-6 col-lg-3">
                                <button class="btn green w-100">Zapisz</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            <div class="col-12 col-md-12">-->
<!--                <div class="card settings__view">-->
<!--                    <div class="card-header mb-3">-->
<!--                        <div class="table__top purple">-->
<!--                            <h5>-->
<!--                                Ustawienia Powiadomień-->
<!--                            </h5>-->
<!--                            <span>-->
<!--                                Pozwala dostosować typy powiadomień, które mają być wysyłane, oraz gdzie mają być wysyłane-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <nav>-->
<!--                            <div class="nav nav-tabs ps-3" id="nav-tab" role="tablist">-->
<!--                                <button class="nav-link active" id="nav-notifications-tab" data-bs-toggle="tab"-->
<!--                                        data-bs-target="#nav-notifications" type="button" role="tab" aria-controls="nav-notifications"-->
<!--                                        aria-selected="true">Powiadomienia w panelu-->
<!--                                </button>-->
<!--                                <button class="nav-link" id="nav-email-notifications-tab" data-bs-toggle="tab"-->
<!--                                        data-bs-target="#nav-email-notifications" type="button" role="tab"-->
<!--                                        aria-controls="nav-email-notifications" aria-selected="false">Powiadomienia E-mail-->
<!--                                </button>-->
<!--                                <button class="nav-link" id="nav-sms-notifications-tab" data-bs-toggle="tab"-->
<!--                                        data-bs-target="#nav-sms-notifications" type="button" role="tab"-->
<!--                                        aria-controls="nav-sms-notifications" aria-selected="false">Powiadomienia SMS-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </nav>-->
<!--                        <div class="tab-content" id="nav-tabContent">-->
<!--                            <div class="tab-pane fade show active" id="nav-notifications" role="tabpanel"-->
<!--                                 aria-labelledby="nav-notifications-tab">-->
<!--                                <form class="mt-4 ms-3">-->
<!--                                    <div class="row">-->
<!--                                        <div class="col-12 col-md-2">-->
<!--                                            Ukończenie zlecenia-->
<!--                                        </div>-->
<!--                                        <div class="col-12 col-md-2">-->
<!--                                            <input type="checkbox" class="form-check-input">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </div>-->
<!--                            <div class="tab-pane fade" id="nav-email-notifications" role="tabpanel"-->
<!--                                 aria-labelledby="nav-email-notifications-tab">-->
<!--                                <form class="mt-4">-->

<!--                                </form>-->
<!--                            </div>-->
<!--                            <div class="tab-pane fade" id="nav-sms-notifications" role="tabpanel"-->
<!--                                 aria-labelledby="nav-sms-notifications-tab">-->
<!--                                <form>-->

<!--                                </form>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="card-footer">-->
<!--                        <div class="row justify-content-end">-->
<!--                            <div class="col-12 col-md-6 col-lg-3">-->
<!--                                <button class="btn green w-100">Zapisz</button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</template>

<script>
export default {
    name: 'Settings',
}
</script>
