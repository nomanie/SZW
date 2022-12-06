<template>
    <div class="card-edit m-3">
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
                        <info></info>
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
                        <contact></contact>
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
    </div>
</template>

<script>
import places from './Partials/places'
import additionalFields from './Partials/additionalFields'
import customForm from './Partials/customForm'
import contact from './Partials/contact'
import info from './Partials/info'
export default {
    name: 'Information',
    components: {
        places,
        additionalFields,
        customForm,
        contact,
        info
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
