<template>
    <div>
        <div class="btn-add" data-bs-toggle="modal" data-bs-target="#workerModal">
            <i class="fa fa-plus"></i>
            <div class="cut"></div>
            <div class="text">
                Pracownika
            </div>
        </div>
        <div class="modal fade modal-lg" tabindex="-1" id="workerModal">
            <div class="modal-dialog">
                <div class="modal-content overflow-hidden">
                    <div class="modal-header">
                        <h5 class="modal-title">Dodaj nowego pracownika</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Imię pracownika:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="text" placeholder="Imię pracownika" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Nazwisko pracownika:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="text" placeholder="Nazwisko pracownika" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Zatrudniony od:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Zatrudniony do:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Adres E-mail:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="email" placeholder="Adres e-mail" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Hasło:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="password" placeholder="Hasło" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Stanowisko:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="text" placeholder="Stanowisko" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Typ umowy:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <select class="form-select">
                                                        <option value="#" disabled selected>Wybierz rodzaj umowy</option>
                                                        <option value="0">Umowa o dzieło</option>
                                                        <option value="1">Umowa zlecenie</option>
                                                        <option value="2">Umowa o pracę</option>
                                                        <option value="3">Kontrakt</option>
                                                        <option value="4">B2B</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Pensja:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input type="text" placeholder="np. 3650,50" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Notatki:
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <textarea class="form-control" placeholder="uwagi"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-warning"><i class="fa fa-eraser pe-3"></i> Wyczyść</button>
                        <div>
                            <button type="button" class="btn btn-success me-4"><i class="fa fa-save pe-3"></i> Zapisz</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark pe-3"></i>
                                Anuluj
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data(){
        return {
            modalShow: true
        }
    }
}
</script>
