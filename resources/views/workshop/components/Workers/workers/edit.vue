<template>
    <div class="card-edit">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <div class="avatar">
                            <img src="../../../../../../public/images/person.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 card-header">
                <div>
                    {{ this.form.first_name }} {{ this.form.last_name }}
                    <div class="position">{{ this.form.position }}</div>
                </div>

                <button class="btn btn-primary">
                    <i class="fa fa-camera"></i>
                    Zmień zdjęcie
                </button>
            </div>
            <div class="col-12 col-lg-5 flex-column d-flex align-items-end">
                <div class="d-flex w-75 flex-column">
                    <button class="btn btn-warning">
                        <i class="fa fa-floppy-disk"></i>
                        Archiwizuj
                    </button>
                    <button class="btn btn-danger mt-2">
                        <i class="fa fa-trash"></i>
                        Usuń
                    </button>
                    <button class="btn btn-success mt-2">
                        <i class="fa fa-hammer"></i>
                        Przydziel zadanie
                    </button>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <b-tabs content-class="mt-3">
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-address-card"></i>
                        Informacje
                    </template>
                    <form class="mt-2">
                        <div class="row">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Imię">
                                    <input v-model="form.first_name" type="text" class="form-control"
                                           placeholder="Imię pracownika">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Nazwisko">
                                    <input v-model="form.last_name" type="text" class="form-control"
                                           placeholder="Nazwisko pracownika">
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Adres e-mail">
                                    <input v-model="form.email" type="text" class="form-control"
                                           placeholder="Adres e-mail pracownika">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Numer telefonu">
                                    <input v-model="form.phone" type="text" class="form-control"
                                           placeholder="Numer telefonu pracownika">
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Miasto">
                                    <input v-model="form.city" type="text" class="form-control" placeholder="Miasto">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Ulica">
                                    <input v-model="form.street" type="text" class="form-control" placeholder="Ulica">
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-lg-4 px-3">
                                <b-form-group label="Kod pocztowy">
                                    <input v-model="form.zip" type="text" class="form-control"
                                           placeholder="Kod pocztowy">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-4 px-3">
                                <b-form-group label="Numer Budynku">
                                    <input v-model="form.building_number" type="text" class="form-control"
                                           placeholder="Numer Budynku">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-4 px-3">
                                <b-form-group label="Numer mieszkania">
                                    <input v-model="form.flat_number" type="text" class="form-control"
                                           placeholder="Numer mieszkania">
                                </b-form-group>
                            </div>
                        </div>
                    </form>
                </b-tab>
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-file-signature"></i>
                        Umowa
                    </template>
                    <form class="mt-2">
                        <div class="row">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Umowa od">
                                    <input v-model="form.contract_from" type="date" class="form-control">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Umowa do">
                                    <input v-model="form.contract_to" type="date" class="form-control">
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Rodzaj umowy">
                                    <v-select
                                        v-model="form.contract_type"
                                        :options="options"
                                        placeholder="Wybierz rodzaj umowy"
                                        :clearable="false"
                                    >
                                    </v-select>
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Stanowisko">
                                    <input v-model="form.position" type="text" class="form-control" placeholder="Stanowisko pracownika">
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Stawka">
                                    <b-input v-model="form.salary" type="text" placeholder="Stawka pracownika"></b-input>
                                </b-form-group>
                            </div>
                        </div>
                    </form>
                </b-tab>
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-list-check"></i>
                        Przypisane zadania
                    </template>
                </b-tab>
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-calendar"></i>
                        Kalendarz
                    </template>
                </b-tab>
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-lock"></i>
                        Permisje
                    </template>
                    <div class="row">
                        <div class="col">
                            <b-form-checkbox-group
                                class="checkbox-group"
                                v-model="form.permissions"
                            >
                                <div class="row">
                                    <div
                                        class="col-12 col-lg-6"
                                         v-for="(permission, index) in permissions"
                                         :key="index"
                                    >
                                        <b-form-checkbox :value="index" class="me-1">
                                            {{ permission }}
                                        </b-form-checkbox>
                                    </div>
                                </div>
                            </b-form-checkbox-group>

                        </div>
                    </div>
                </b-tab>
            </b-tabs>
            <hr class="mt-3">
            <div class="row mt-3">
                <div class="col-12 col-lg-6 d-flex px-3">
                    <b-button variant="danger" @click="$emit('close')" class="me-2">
                        <i class="fa fa-xmark"></i>
                        Zamknij edycje
                    </b-button>
                </div>
                <div class="col-12 col-lg-6 d-flex justify-content-end px-3">
                    <b-button variant="warning" @click="getData()" class="me-2">
                        <i class="fa fa-eraser"></i>
                        Cofnij zmiany
                    </b-button>
                    <b-button variant="success" @click="save()">
                        <i class="fa fa-floppy-disk"></i>
                        Zapisz
                    </b-button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'edit',
    props: {
        id: {
            type: Number,
            default: () => null
        }
    },
    data() {
        return {
            form: {},
            options: [],
            permissions: {}
        }
    },
    watch: {
        'form': {
            deep: true,
            handler(value) {
                this.$emit('update', value)
            }
        }
    },
    mounted() {
        this.getData()
        this.getOptions()
        this.getPermissionList()
    },
    methods: {
        getData() {
            this.$http.get(route('api.workers.show', this.id)).then((response) => {
                this.form = response.data
            }).catch((error) => {
                console.log(error)
            })
        },
        getOptions() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\WorkshopMiddleware\\ContractTypeEnum'})).then((response) => {
                this.options = response.data
            }).catch((error) => {
                this.$bvToast.toast('Nie udało się pobrać opcji', {
                    title: 'Błąd',
                    autoHideDelay: 5000,
                    variant: 'danger',
                })
            })
        },
        getPermissionList() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\WorkshopMiddleware\\PermissionEnum'})).then((response) => {
                this.permissions = response.data
                console.log(this.permissions)
            }).catch((error) => {
                this.$bvToast.toast('Nie udało się pobrać opcji', {
                    title: 'Błąd',
                    autoHideDelay: 5000,
                    variant: 'danger',
                })
            })
        }
    }
}
</script>
