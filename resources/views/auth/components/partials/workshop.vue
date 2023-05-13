<template>
    <div class="container mt-5 login mb-3">
        <div>
            <div class="row">
                <div class="col-12 text-center">
                    <h4>Tworzenie konta dla warsztatu</h4>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="name">Nazwa warsztatu</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Nazwa warsztatu"
                        v-model="form.name"
                        :class="{invalid : errors.name}"
                    >
                    <error :errors="errors.name"></error>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="email">Adres e-mail</label>
                    <input
                        class="form-control"
                        type="email"
                        placeholder="Adres e-mail"
                        v-model="form.email"
                        :class="{invalid : errors.email}"
                    >
                    <error :errors="errors.email"></error>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="nip">NIP firmy</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="NIP firmy"
                        v-model="form.nip"
                        :class="{invalid : errors.nip}"
                    >
                    <error :errors="errors.nip"></error>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="regon">REGON firmy</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="REGON firmy"
                        v-model="form.regon"
                        :class="{invalid : errors.regon}"
                    >
                    <error :errors="errors.regon"></error>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="password">Hasło</label>
                    <input
                        class="form-control"
                        type="password"
                        placeholder="Hasło"
                        v-model="form.password"
                        :class="{invalid : errors.password}"
                    >
                    <error :errors="errors.password"></error>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="password_confirmation">Potwierdź hasło</label>
                    <input
                        class="form-control"
                        type="password"
                        placeholder="Hasło"
                        v-model="form.password_confirmation"
                        :class="{invalid : errors.password_confirmation}"
                    >
                    <error :errors="errors.password_confirmation"></error>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <button class="btn btn-primary w-100" @click="save">
                        Utwórz konto
                    </button>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4 d-flex justify-content-between">
                    <router-link :to="{ name: 'login' }">
                        Masz już konto?
                    </router-link>
                    <router-link :to="{ name: 'register' }">
                        Confij do listy wyboru
                    </router-link>
                </div>
            </div>
        </div>
        <loader></loader>
    </div>
</template>
<script>
import error from '../../../../js/assets/form/error.vue'
import loader from "@js/components/Loader";
import { mapState, mapActions } from 'vuex'

export default {
    name: 'workshop',
    components: {
        error,
        loader,
    },
    data() {
        return {
            form: {},
            errors: {},
            processing: false
        }
    },
    mounted() {
        this.defaultForm()
    },
    methods: {
        ...mapActions({
            signIn:'auth/login'
        }),

        defaultForm() {
            this.form = {
                name: null,
                nip: null,
                regon: null,
                email: null,
                password: null,
                password_confirmation: null
            }
        },
        async save() {
            this.processing = true
            await this.$http.get('/sanctum/csrf-cookie').then(response => {
                this.$http.post(route('register.workshop.post'), this.form).then((response) => {
                    // this.signIn()
                }).catch((error) => {
                    this.errors = error.data.errors
                }).finally(()=>{
                    this.processing = false
                })
            })
        }
    }
}
</script>
