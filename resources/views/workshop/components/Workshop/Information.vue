<template>
    <div class="card-edit">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <div class="avatar">
                            <img src="../../../../../public/images/person.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex align-items-center">
                <div>
                </div>

                <button class="btn btn-primary">
                    <i class="fa fa-camera"></i>
                    Zmień Logo
                </button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <b-tabs content-class="mt-3" class="w-100">
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-address-card"></i>
                            Informacje
                        </template>
                        <form class="mt-2 mx-3">
                            <h5>Podstawowe Dane</h5>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-6 px-3">
                                    <b-form-group label="Nazwa firmy">
                                        <b-input type="text" v-model="form.name" placeholder="Nazwa firmy">

                                        </b-input>
                                    </b-form-group>
                                </div>
                                <div class="col-12 col-lg-6 px-3">
                                    <b-form-group label="Data utworzenia firmy">
                                        <b-input type="date" v-model="form.company_created_at"
                                                 placeholder="Data utworzenia firmy">

                                        </b-input>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-6 px-3">
                                    <b-form-group label="REGON firmy">
                                        <b-input type="text" v-model="form.regon" placeholder="REGON firmy">

                                        </b-input>
                                    </b-form-group>
                                </div>
                                <div class="col-12 col-lg-6 px-3">
                                    <b-form-group label="NIP firmy">
                                        <b-input type="text" v-model="form.nip" placeholder="NIP firmy">

                                        </b-input>
                                    </b-form-group>
                                </div>
                            </div>
                            <owners></owners>
                        </form>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-building"></i>
                            Placówki
                        </template>
                        <places></places>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-mobile-phone"></i>
                            Dane kontaktowe
                        </template>
                        <div class="mt-3 px-3">
                            <h5>Dane kontaktowe</h5>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-6 px-3">
                                    <b-form-group label="Telefon do firmy">
                                        <b-input type="text" placeholder="Telefon do firmy" v-model="form.phone">

                                        </b-input>
                                    </b-form-group>
                                </div>
                                <div class="col-12 col-lg-6 px-3">
                                    <b-form-group label="Adres e-mail">
                                        <b-input type="text" placeholder="Adres e-mail" v-model="form.email">

                                        </b-input>
                                    </b-form-group>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-6 px-3">
                                    <b-form-group label="Strona internetowa">
                                        <b-input type="text" placeholder="Strona internetowa" v-model="form.website">

                                        </b-input>
                                    </b-form-group>
                                </div>
                            </div>
                            <h5 class="mt-3">Media społecznościowe</h5>
                            <hr>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-6 px-3">
                                    <div class="social_media_container d-flex">
                                        <i class="fa fa-facebook"></i>
                                        <b-input type="text">
                                        </b-input>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-lg-6 px-3">
                                    <div class="social_media_container d-flex">
                                        <i class="fa fa-instagram"></i>
                                        <b-input type="text">
                                        </b-input>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-lg-6 px-3">
                                    <div class="social_media_container d-flex">
                                        <i class="fa fa-linkedin"></i>
                                        <b-input type="text">
                                        </b-input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-rectangle-list"></i>
                            Formularz kontaktowy
                        </template>
                        <custom-form :field-types="fieldTypes"></custom-form>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-plus"></i>
                            Dodatkowe dane
                        </template>
                        <additional-fields :field-types="fieldTypes"></additional-fields>
                    </b-tab>
                </b-tabs>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr class="mt-3">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-end px-3">
                <b-button variant="warning" class="mr-2">
                    <i class="fa fa-eraser"></i>
                    Cofnij zmiany
                </b-button>
                <b-button variant="success" @click="save">
                    <i class="fa fa-floppy-disk"></i>
                    Zapisz
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
import owners from './Partials/owners'
import places from './Partials/places'
import additionalFields from './Partials/additionalFields'
import customForm from './Partials/customForm'

export default {
    name: 'Information',
    components: {
        owners,
        places,
        additionalFields,
        customForm
    },
    data() {
        return {
            fieldTypes: [],
            form: {},
        }
    },
    mounted() {
        this.getFieldTypes()
        this.getData()
    },
    methods: {
        getFieldTypes() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\WorkshopMiddleware\\FieldTypeEnum'})).then((response) => {
                this.fieldTypes = response.data
            })
        },
        getData() {
            this.form.id = 1
        },
        save() {
            this.$http.put(route('api.workshop.update', this.form.id), this.form).then((response) => {
                this.$bvToast.toast('Pomyślnie zapisano dane', {
                    title: 'Komunikat',
                    autoHideDelay: 5000,
                    variant: 'success',
                })
            }).catch((error) => {
                this.$bvToast.toast('Wystąpił błąd podczas zapisu', {
                    title: 'Błąd',
                    autoHideDelay: 5000,
                    variant: 'danger',
                })
            })
        }
    }
}
</script>
