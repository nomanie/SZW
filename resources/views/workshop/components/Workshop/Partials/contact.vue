<template>
    <div>
        <div class="mt-3 px-3">
            <h5>Dane kontaktowe</h5>
            <hr>
            <div class="row">
                <div class="col-12 col-lg-6 px-3">
                    <b-form-group label="Telefon do firmy">
                        <b-input
                            type="text"
                            placeholder="Telefon do firmy"
                            v-model="form.phone"
                            :class="{invalid : errors.phone}"
                        >
                        </b-input>
                        <error :errors="errors.phone"></error>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-6 px-3">
                    <b-form-group label="Adres e-mail">
                        <b-input
                            type="text"
                            placeholder="Adres e-mail"
                            v-model="form.email"
                            :class="{invalid : errors.email}"
                        >
                        </b-input>
                        <error :errors="errors.email"></error>
                    </b-form-group>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-lg-6 px-3">
                    <b-form-group label="Strona internetowa">
                        <b-input
                            type="text"
                            placeholder="Strona internetowa"
                            v-model="form.website"
                        >
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
                        <b-input
                            type="text"
                            v-model="form.social_media.facebook"
                        >
                        </b-input>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-lg-6 px-3">
                    <div class="social_media_container d-flex">
                        <i class="fa fa-instagram"></i>
                        <b-input
                            type="text"
                            v-model="form.social_media.instagram"
                        >
                        </b-input>
                    </div>
                </div>
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
                <b-button variant="success" @click="save()">
                    <i class="fa fa-floppy-disk"></i>
                    Zapisz
                </b-button>
            </div>
        </div>
    </div>
</template>
<script>
import error from '@js/assets/form/error'
export default {
    name: 'contact',
    components: {
        error
    },
    props: {
        id: {
            type: Number,
            default: () => null
        },
        data: {
            type: [Object, Array],
            default: () => {}
        }
    },
    data() {
        return {
            errors: {},
            form: {
                email: null,
                phone: null,
                social_media: {
                    facebook: null,
                    instagram: null
                }
            },
        }
    },
    mounted() {
        if (this.data) {
            this.form = this.data
        }
    },
    methods: {
        save() {
            this.form.section = 'contact'
            this.$http.put(route('workshop.workshops.update', this.id), this.form).then(() => {

            })
        }
    }
}
</script>
