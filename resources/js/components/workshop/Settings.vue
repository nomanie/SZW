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
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 1</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 2</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 3</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-centered">
                                <label for="">Kolor 4</label>
                                <div>
                                    <input type="color">
                                </div>
                            </div>
                        </div>
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
        </div>
    </div>
</template>

<script>
export default {
    name: 'Settings',
}
</script>
