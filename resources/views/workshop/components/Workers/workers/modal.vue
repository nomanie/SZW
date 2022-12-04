<template>
    <div>
        <div class="btn btn-primary" @click="$bvModal.show('worker-modal'); defaultForm();">
            <i class="fa fa-plus me-2"></i>
<!--            <div class="cut"></div>-->
<!--            <div class="text">-->
                Pracownika
<!--            </div>-->
        </div>
        <b-modal id="worker-modal" title="Dodaj nowego pracownika" size="lg">
            <form>
                <p>Dane pracownika</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Imię pracownika:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.first_name"
                                            type="text"
                                            placeholder="Imię pracownika"
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
                                Nazwisko pracownika:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.last_name"
                                            type="text"
                                            placeholder="Nazwisko pracownika"
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
                                Login:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.login"
                                            type="login"
                                            placeholder="Login"
                                            class="form-control"
                                            :class="{invalid : errors.login}"
                                        >
                                        <error :errors="errors.login"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p>Umowa</p>
                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Zatrudniony do:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.contract_to"
                                            type="date"
                                            class="form-control"
                                            :class="{invalid : errors.contract_to}"
                                        >
                                        <error :errors="errors.contract_to"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col item">
                                Zatrudniony od:
                                <div>
                                    <div class="input__wrapper mt-1">
                                        <input
                                            v-model="form.contract_from"
                                            type="date"
                                            class="form-control"
                                            :class="{invalid : errors.contract_from}"
                                        >
                                        <error :errors="errors.contract_from"></error>
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
                                        <input
                                            v-model="form.position"
                                            type="text"
                                            placeholder="Stanowisko"
                                            class="form-control"
                                            :class="{invalid : errors.position}"
                                        >
                                        <error :errors="errors.position"></error>
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
                                        <v-select
                                            v-model="form.contract_type"
                                            :options="options"
                                            :class="{invalid : errors.contract_type}"
                                            placeholder="Wybierz rodzaj umowy"
                                        >
                                        </v-select>
                                        <error :errors="errors.contract_type"></error>
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
                                        <input
                                            v-model="form.salary"
                                            type="text"
                                            placeholder="np. 3650,50"
                                            class="form-control"
                                            :class="{invalid : errors.salary}"
                                        >
                                        <error :errors="errors.salary"></error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">

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
            <template #modal-footer>
                <div class="w-100 justify-content-between d-flex">
                    <button type="button" class="btn btn-warning me-4" @click="defaultForm"><i class="fa fa-eraser pe-3"></i>
                        Wyczyść
                    </button>
                    <div>
                        <button type="button" class="btn btn-success" @click="btnUrl"><i class="fa fa-save pe-3"></i>
                            Zapisz
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
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
import error from '../../../../../js/assets/form/error'

export default {
    components: {
        error
    },
    props: {
        data: {
            type: [Object, Array],
            default: () => {}
        }
    },
    data() {
        return {
            modalShow: true,
            form: this.data,
            is_edit: false,
            errors: {},
            options: []
        }
    },
    mounted() {
        this.getOptions()
    },
    watch: {
        data: function() {
            this.form = this.data
            this.is_edit = true
            this.$bvModal.show('worker-modal')
        }
    },
    computed: {
        btnUrl() {
            return this.is_edit ? this.edit : this.save
        }
    },
    methods: {
        defaultForm() {
            this.form = {
                first_name: null,
                last_name: null,
                contract_from: null,
                contract_to: null,
                login: null,
                phone: null,
                contract_type: null,
                position: null,
                salary: null,
                info: null
            }
        },
        save() {
            this.$http.post(route('api.workshop.workers.store'), this.form).then((response) => {
                this.$bvModal.hide('worker-modal')
                this.$emit('reload')
            })
        },
        edit() {
            this.$http.put(route('api.workshop.workers.update', this.form.id), this.form).then((response) => {
                this.$bvModal.hide('worker-modal')
                this.$emit('reload')
            })
        },
        getOptions() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\WorkshopMiddleware\\ContractTypeEnum'})).then((response) => {
                this.options = response.data
            })
        }
    }
}
</script>
