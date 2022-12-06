<template>
    <div class="container mt-5 login">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img :src="img" height="120">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-center text">
                        Zaloguj się
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-12 col-md-4">
                        <label for="login">Adres e-mail</label>
                        <input
                            v-model="form.email"
                            type="email"
                            class="form-control"
                            placeholder="Adres e-mail"
                            :class="{invalid : errors.email}"
                        >
                        <error :errors="errors.email"></error>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-12 col-md-4">
                        <label for="password">Hasło</label>
                        <input
                            v-model="form.password"
                            type="password"
                            class="form-control"
                            placeholder="Hasło"
                            :class="{invalid : errors.password}"
                        >
                        <error :errors="errors.password"></error>
                    </div>
                </div>
                <div class="row mt-2 justify-content-center">
                    <div class="col-12 col-md-4">
                        <b-form-checkbox
                            v-model="form.remember_me"
                            :class="{invalid : errors.remember_me}"
                        >
                            Zapamiętaj mnie
                        </b-form-checkbox>
                        <error :errors="errors.remember_me"></error>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-12 col-md-4 d-flex justify-content-center">
                        <button class="btn btn-primary w-50" @click="login()">Zaloguj się</button>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        <h5>Nie masz jeszcze konta?</h5>
                    </div>
                </div>
                <div class="row mt-2 justify-content-center">
                    <div class="col-12 col-md-4 d-flex justify-content-center">
                        <a href="/register" class="w-50">
                            <button class="btn btn-warning w-100">Zarejestruj się</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <loader :loading="loading"></loader>
    </div>
</template>
<script>
import error from "@js/assets/form/error";
import loader from "@js/components/Loader";
export default {
    name: 'login',
    components: {
        error,
        loader
    },
    props: {
        img: {
            type: String,
            default: () => null
        },
        verified: {
            type: Boolean,
            default: () => false
        }
    },
    data() {
        return {
            form: {
                email: null,
                password: null,
                remember_me: false
            },
            loading: false,
            errors: {}
        }
    },
    mounted() {
        if (this.verified) {
            this.$bvToast.toast('Adres e-mail został potwierdzony', {
                title: 'Komunikat', variant: 'success', toaster: 'b-toaster-top-center'
            })
        }
    },
    methods: {
        login() {
            this.$http.post(route('login'), this.form).then((response) => {
                localStorage.setItem('id', response.data.id)
                window.location = response.data.route
            }).catch((error) => {
                this.errors = error.data.errors
            })
        }
    }
}
</script>
