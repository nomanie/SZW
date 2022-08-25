<template>
    <div>
        <div class="row mt-5">
            <div class="col-8  mx-auto">
                <div class="card">
                    <div class="card-header mb-3">
                        <div class="table__top red">
                            <h5>
                                Wyślij zgłoszenie
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <input type="text" placeholder="Temat" class="form-control">
                            <select class="form-select mt-3">
                                <option value="#" disabled selected>Wybierz typ zgłoszenia</option>
                            </select>
                            <textarea rows="5" class="form-control mt-3" placeholder="Opis sytuacji"></textarea>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn red mt-3">Wyślij zgłoszenie</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        Dziękujemy za zgłoszenie problemu, postaramy się go rozwiązać jak najszybciej. Gdy wiadomość zostanie odczytana zostaniesz o tym powiadomiony.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ErrorReport'
}
</script>
