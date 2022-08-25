<template>
    <div class="informations mt-5">
        <div class="row mt-5">
            <div class="col-8  mx-auto mt-5">
                <div class="card">
                    <div class="card-header mb-3 d-flex position-relative justify-content-end">
                        <div class="table__top avatar">
                            <img src="../../../../public/images/person.jpg" class="w-100">
                        </div>
                        <div class="table__top blue w-75 h-50">
                            <h5>
                                Informacje o Warsztacie
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs ps-3" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Główne Informacje</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Godziny Otwarcia</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#social-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Media społecznościowe</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form class="mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6 pe-4">
                                            <label for="" class="mb-2">Nazwa Warsztatu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 ps-4">
                                            <label for="" class="mb-2">Typ Warsztatu</label>
                                            <select class="form-select">
                                                <option value="#" selected disabled>Wybierz Typ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-6 pe-4">
                                            <label for="" class="mb-2">Numer Telefonu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 ps-4">
                                            <label for="" class="mb-2">Adres E-mail</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-6 pe-4">
                                            <label for="" class="mb-2">REGON Warsztatu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 ps-4">
                                            <label for="" class="mb-2">NIP Warsztatu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-6 pe-4">
                                            <label for="" class="mb-2">Miasto</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 ps-4">
                                            <label for="" class="mb-2">Ulica</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-6 pe-4">
                                            <label for="" class="mb-2">Numer budynku/lokalu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 ps-4">
                                            <label for="" class="mb-2">Kod pocztowy</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-6 pe-4">
                                            <label for="" class="mb-2">REGON Warsztatu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 ps-4">
                                            <label for="" class="mb-2">NIP Warsztatu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <label for="" class="mb-2">Imię i Nazwisko Właściciela Warsztatu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form class="mt-3">
                                    <div class="row" v-for="day in days">
                                        <div class="col-12 col-md-3">
                                            {{ day }}
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="number" min="0" max="24" placeholder="00" class="no-border text-end">
                                            :
                                            <input type="number" min="0" max="60" placeholder="00" class="no-border">
                                            -
                                            <input type="number" min="0" max="24" placeholder="00" class="no-border text-end">
                                            :
                                            <input type="number" min="0" max="60" placeholder="00" class="no-border">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="social-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form class="mt-3">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-3">
                                            Strona WWW:
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" placeholder="Link" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-12 col-md-3">
                                            Facebok:
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" placeholder="Link" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-12 col-md-3">
                                            Instagram:
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" placeholder="Link" class="form-control">
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
    </div>
</template>

<script>

export default {
    name: 'Information',
    data() {
        return {
            days: ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela']
        }
    }
}
</script>
