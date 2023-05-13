<template>
    <div>
        <b-modal id="clients-modal" title="Dodaj nowego Klienta" size="lg" @shown="defaultForm">
            <form>
                <p>Dane Klienta</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Imię:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.first_name"
                                            type="text"
                                            placeholder="Imię"
                                            class="form-control"
                                            :class="{invalid : errors.first_name}"
                                        >
                                        <error :errors="errors.first_name"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Nazwisko:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.last_name"
                                            type="text"
                                            placeholder="Nazwisko"
                                            class="form-control"
                                            :class="{invalid : errors.last_name}"
                                        >
                                        <error :errors="errors.last_name"></error>
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
                                Numer telefonu:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.phone"
                                            type="text"
                                            class="form-control"
                                            placeholder="Numer telefonu"
                                            :class="{invalid : errors.phone}"
                                        >
                                        <error :errors="errors.phone"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Adres e-mail:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.email"
                                            type="email"
                                            placeholder="Adres e-mail"
                                            class="form-control"
                                            :class="{invalid : errors.email}"
                                        >
                                        <error :errors="errors.email"></error>
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
                                Data urodzenia:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.date_of_birth"
                                            type="date"
                                            class="form-control"
                                            placeholder="Data urodzenia"
                                            :class="{invalid : errors.date_of_birth}"
                                        >
                                        <error :errors="errors.date_of_birth"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p>Adres</p>
                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Miasto:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.city"
                                            type="text"
                                            placeholder="Miasto"
                                            class="form-control"
                                            :class="{invalid : errors.city}"
                                        >
                                        <error :errors="errors.city"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Ulica:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.street"
                                            type="text"
                                            placeholder="Ulica"
                                            class="form-control"
                                            :class="{invalid : errors.street}"
                                        >
                                        <error :errors="errors.street"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col item">
                                Kod pocztowy:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <format-field
                                            :key='form.zip_code'
                                            :data='form.zip_code'
                                            :min="0"
                                            :max="6"
                                            :state="errors.zip_code && errors.zip_code.length > 0"
                                            format="..-..."
                                            placeholder="Kod pocztowy"
                                            @input="form.zip_code = $event"
                                        ></format-field>
                                        <error :errors="errors.zip_code"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col item">
                                Numer budynku:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.building_number"
                                            type="text"
                                            placeholder="Numer budynku"
                                            class="form-control"
                                            :class="{invalid : errors.building_number}"
                                        >
                                        <error :errors="errors.building_number"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col item">
                                Numer lokalu:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.flat_number"
                                            type="text"
                                            placeholder="Numer lokalu"
                                            class="form-control"
                                            :class="{invalid : errors.flat_number}"
                                        >
                                        <error :errors="errors.flat_number"></error>
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
                                        <textarea v-model="form.info" class="form-control"
                                                  placeholder="uwagi"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <template #modal-footer="{cancel}">
                <div class="w-100 justify-content-between d-flex">
                    <button type="button" class="btn btn-warning me-4" @click="defaultForm"><i
                        class="fa fa-eraser pe-3"></i>
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
            default: () => {
            }
        },
        show: {
            type: Boolean,
            default: () => {
            }
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
        data: function () {
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
                    first_name: null,
                    last_name: null,
                    phone: null,
                    info: null,
                    email: null,
                    zip_code: null,
                    building_number: null,
                    flat_number: null,
                    city: null,
                    street: null,
                    date_of_birth: null,
                }
            }
        },
        save() {
            this.$http.get('/sanctum/csrf-cookie').then(response => {
                this.$http.post(route('workshop.clients.store', {tenant: this.$store.state.auth.user.uuid}), this.form).then((response) => {
                    this.$bvModal.hide('clients-modal')
                    this.$emit('reload')
                })
            })

        },
        edit() {
            this.$http.put(route('workshop.clients.update', {tenant: this.$store.state.auth.user.uuid, client: this.form.id}), this.form).then((response) => {
                this.$bvModal.hide('clients-modal')
                this.$emit('reload')
            })
        }
    }
}
</script>
