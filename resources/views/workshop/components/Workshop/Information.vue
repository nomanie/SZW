<template>
    <div class="card-edit m-3 position-relative">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <div class="avatar">
                            <img :src="getLogo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex align-items-center">
                <div>
                </div>
                <input ref="fileUpload" type="file" hidden @change="saveImage">
                <button class="btn btn-primary" @click="$refs.fileUpload.click()">
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
                        <info
                            :key="form.id"
                            :id="form.id"
                            :data="form.informations"
                            :owners="form.owners"
                        ></info>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-building"></i>
                            Placówki
                        </template>
                        <places
                            :key="form.id"
                            :id="form.id"
                            :data="form.places"
                        ></places>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-mobile-phone"></i>
                            Dane kontaktowe
                        </template>
                        <contact
                            :key="form.id"
                            :id="form.id"
                            :data="form.contact"
                        ></contact>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-rectangle-list"></i>
                            Formularz kontaktowy
                        </template>
                        <custom-form
                            :field-types="fieldTypes"
                            :key="form.id"
                            :id="form.id"
                            :data="form.contact_form"
                        ></custom-form>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            <i class="fa-solid fa-plus"></i>
                            Dodatkowe dane
                        </template>
                        <additional-fields
                            :field-types="fieldTypes"
                            :key="form.id"
                            :id="form.id"
                            :data="form.additional_fields"
                        ></additional-fields>
                    </b-tab>
                </b-tabs>
            </div>
        </div>
        <loader></loader>
    </div>
</template>

<script>
import places from './Partials/places'
import additionalFields from './Partials/additionalFields'
import customForm from './Partials/customForm'
import contact from './Partials/contact'
import info from './Partials/info'
import loader from "@js/components/Loader";

export default {
    name: 'Information',
    components: {
        places,
        additionalFields,
        customForm,
        contact,
        info,
        loader
    },
    data() {
        return {
            file: null,
            fieldTypes: [],
            form: {},
        }
    },
    mounted() {
        this.getFieldTypes()
        this.getData()
    },
    computed: {
        getLogo() {
            return (this.form.logo !== null ? this.form.logo : 'http://127.0.0.1:8000/images/person.jpg')
        }
    },
    methods: {
        getFieldTypes() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\Workshop\\FieldTypeEnum'})).then((response) => {
                this.fieldTypes = response.data
            })
        },
        getData() {
            this.$http.get(route('workshop.workshops.index')).then((response) => {
                this.form = response.data.data
            })
        },
        saveImage($event) {
            if ($event.target.files[0] !== undefined) {
                let formData = new FormData();
                formData.append('image', $event.target.files[0]);
                this.$http.post(route('workshop.upload.logo', this.form.id), formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    }
                }).then((response) => {
                    this.form.logo = response.data.data.file
                })
            }
        }
    }
}
</script>
