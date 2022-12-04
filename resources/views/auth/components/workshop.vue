<template>
    <div class="container mt-5 login mb-3">
        <div v-if="!created">
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
                <div class="col-12 col-lg-4">
                    <a href="/login">Masz już konto?</a>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="row justify-content-center mt-5 mb-3">
                <div class="col-12 col-lg-4 text-center">
                    <h3>Konto zostało założone!</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <a href="/login" class="w-100">
                        <button class="btn btn-primary w-100 fs-20">
                            Zaloguj się
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <loader :loading="loading"></loader>
    </div>
</template>
<script>
import error from '../../../js/assets/form/error'
import loader from "@js/components/Loader";

export default {
    name: 'workshop',
    components: {
        error,
        loader
    },
    data() {
        return {
            form: {},
            errors: {},
            created: false,
            loading: false
        }
    },
    mounted() {
        this.defaultForm()
    },
    methods: {
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
        save() {
            this.$http.post(route('register.workshop.post'), this.form).then((response) => {
                this.created = true
            }).catch((error) => {
                this.errors = error.data.errors
            })
        }
    }
}
</script>
