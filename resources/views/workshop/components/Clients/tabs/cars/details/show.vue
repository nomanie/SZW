<template>
    <div class="mt-2">
        <b-tabs>
            <b-tab>
                <template #title>Dane</template>
                <div class="mt-3">
                    <form>
                        <p>Samochód</p>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Marka:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.brand"
                                                    type="text"
                                                    placeholder="Marka"
                                                    class="form-control"
                                                    :class="{invalid : errors.brand}"
                                                >
                                                <error :errors="errors.brand"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Model:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.model"
                                                    type="text"
                                                    placeholder="Model"
                                                    class="form-control"
                                                    :class="{invalid : errors.model}"
                                                >
                                                <error :errors="errors.model"></error>
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
                                        Seria:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.seria"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Seria"
                                                    :class="{invalid : errors.seria}"
                                                >
                                                <error :errors="errors.seria"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Generacja:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.generation"
                                                    type="email"
                                                    placeholder="Generacja"
                                                    class="form-control"
                                                    :class="{invalid : errors.generation}"
                                                >
                                                <error :errors="errors.generation"></error>
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
                                        Typ samochodu
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.car_type"
                                                    type="email"
                                                    placeholder="Typ samochodu"
                                                    class="form-control"
                                                    :class="{invalid : errors.car_type}"
                                                >
                                                <error :errors="errors.car_type"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Rodzaj silnika
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.engine"
                                                    type="email"
                                                    placeholder="Adres e-mail"
                                                    class="form-control"
                                                    :class="{invalid : errors.engine}"
                                                >
                                                <error :errors="errors.engine"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p>Dane samochodu</p>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Numery rejestracyjne:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.registration_number"
                                                    type="text"
                                                    placeholder="Numery rejestracyjne"
                                                    class="form-control"
                                                    :class="{invalid : errors.registration_number}"
                                                >
                                                <error :errors="errors.registration_number"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Numer VIN:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.vin_number"
                                                    type="text"
                                                    placeholder="Numer VIN"
                                                    class="form-control"
                                                    :class="{invalid : errors.vin_number}"
                                                >
                                                <error :errors="errors.vin_number"></error>
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
                                        Rok produkcji:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <b-input
                                                    v-model="form.production_date"
                                                    :class="{invalid : errors.production_date}"
                                                    type="text"
                                                >

                                                </b-input>
                                                <error :errors="errors.production_date"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Przebieg:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.distance"
                                                    type="text"
                                                    placeholder="Przebieg"
                                                    class="form-control"
                                                    :class="{invalid : errors.distance}"
                                                >
                                                <error :errors="errors.distance"></error>
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
                                        Data kolejnego przeglądu:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.inspection_date"
                                                    type="date"
                                                    class="form-control"
                                                    :class="{invalid : errors.inspection_date}"
                                                >
                                                <error :errors="errors.inspection_date"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col item">
                                        Data zakończenia ubezpieczenia:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                                <input
                                                    v-model="form.insurance_date"
                                                    type="date"
                                                    class="form-control"
                                                    :class="{invalid : errors.insurance_date}"
                                                >
                                                <error :errors="errors.insurance_date"></error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p>Notatki</p>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col item">
                                        Notatki:
                                        <div>
                                            <div class="input__wrapper mt-1">
                                        <textarea v-model="form.notes" class="form-control"
                                                  placeholder="Notatki"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="w-100 justify-content-end d-flex mt-3">
                        <button type="button" class="btn btn-warning mr-2" @click="reset"><i class="fa fa-eraser pe-3"></i>
                            Resetuj
                        </button>
                        <button type="button" class="btn btn-success" @click="save"><i class="fa fa-save pe-3"></i>
                            Zapisz
                        </button>
                    </div>
                </div>
            </b-tab>
            <b-tab>
                <template #title>Dokumenty</template>
                <div class="text-center fs-20 my-3">
                    <i class="fa-solid fa-hammer"></i>
                    Prace trwają
                </div>
            </b-tab>
            <b-tab>
                <template #title>Naprawy</template>
                <div class="text-center fs-20 my-3">
                    <i class="fa-solid fa-hammer"></i>
                    Prace trwają
                </div>
            </b-tab>
            <b-tab>
                <template #title>Dziennik aktywności</template>
                <div class="text-center fs-20 my-3">
                    <i class="fa-solid fa-hammer"></i>
                    Prace trwają
                </div>
            </b-tab>
        </b-tabs>
    </div>
</template>
<script>
import error from '@js/assets/form/error'
import FormatField from '@js/components/FormatField'
export default {
    components: {
      error
    },
    props: {
        car: {
            type: [Object, Array],
            default: () => {}
        }
    },
    data() {
        return {
            form: {},
            errors: {}
        }
    },
    mounted() {
        this.form = {...this.car}
    },
    methods: {
        save() {
            this.$http.put(route('workshop.cars.update', this.form.id), this.form)
        },
        reset() {
            this.form = {...this.car}
        }
    }
}
</script>
