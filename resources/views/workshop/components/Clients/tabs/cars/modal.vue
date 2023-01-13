<template>
    <div>
        <b-modal id="cars-modal" title="Dodaj nowy Samochód" size="lg" @shown="defaultForm">
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
            <template #modal-footer="{cancel}">
                <div class="w-100 justify-content-between d-flex">
                    <button type="button" class="btn btn-warning me-4" @click="defaultForm"><i class="fa fa-eraser pe-3"></i>
                        Wyczyść
                    </button>
                    <div>
                        <button type="button" class="btn btn-success" @click="btnUrl"><i class="fa fa-save pe-3"></i>
                            Zapisz
                        </button>
                        <button type="button" class="btn btn-danger" @click="cancel()">
                            <i class="fa-solid fa-xmark pe-3"></i>
                            Anuluj
                        </button>
                    </div>
                </div>
            </template>
        </b-modal>
    </div>
</template>
<script>
import error from '@js/assets/form/error'
import FormatField from '@js/components/FormatField'

export default {
    components: {
        error,
        FormatField
    },
    props: {
        data: {
            type: [Object, Array],
            default: () => {}
        },
        show: {
            type: Boolean,
            default: () => {}
        }
    },
    data() {
        return {
            modalShow: true,
            form: this.data,
            is_edit: false,
            errors: {},
        }
    },
    watch: {
        data: function() {
            this.form = this.data
            this.is_edit = true
        },
    },
    computed: {
        btnUrl() {
            return this.is_edit ? this.edit : this.save
        }
    },
    methods: {
        defaultForm() {
            if (!this.is_edit) {
                this.form = {
                    brand: null,
                    model: null,
                    seria: null,
                    generation: null,
                    notes: null,
                    car_type: null,
                    engine: null,
                    registration_number: null,
                    vin_number: null,
                    production_date: null,
                    distance: null,
                    inspection_date: null,
                    insurance_date: null
                }
            }
        },
        save() {
            this.form['client_id'] = this.$route.params.id
            this.$http.post(route('workshop.cars.store'), this.form).then((response) => {
                this.$bvModal.hide('cars-modal')
                this.$emit('reload')
            })
        },
        edit() {
            this.form['client_id'] = this.$route.params.id
            this.$http.put(route('workshop.cars.update', this.form.id), this.form).then((response) => {
                this.$bvModal.hide('cars-modal')
                this.$emit('reload')
            })
        }
    }
}
</script>
