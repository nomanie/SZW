<template>
    <div class="container mt-5 login position-relative">
        <div v-if="!created">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>Tworzenie standardowego konta</h4>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="first_name">Imię</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Imię"
                        v-model="form.first_name"
                        :class="{invalid : errors.first_name}"
                    >
                    <error :errors="errors.first_name"></error>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-4">
                    <label for="last_name">Nazwisko</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Nazwisko"
                        v-model="form.last_name"
                        :class="{invalid : errors.last_name}"
                    >
                    <error :errors="errors.last_name"></error>
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
        <loader></loader>
    </div>
</template>
<script>
import error from "@js/assets/form/error";
import loader from "@js/components/Loader";
export default {
    name: 'client',
    components: {
        error,
        loader
    },
    data() {
        return {
            form: {},
            errors: {},
            created: false
        }
    },
    mounted() {
        this.defaultForm()
    },
    methods: {
        defaultForm() {
            this.form = {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                password_confirmation: null
            }
        },
        save() {
            this.$http.post(route('register.client.post'), this.form).then((response) => {
                this.created = true
            }).catch((error) => {
                this.errors = error.data.errors
            })
        }
    }
}
</script>
