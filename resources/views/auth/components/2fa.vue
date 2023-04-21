<template>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Wprowadź Kod aby zalogować się na konto</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <input v-model="form.code" class="form-control mb-2 mt-4 w-100" type="password" name="password" placeholder="Wpisz kod">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 mt-3">
                <button class="btn btn-primary w-100" @click="save()">Zaloguj się</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 mt-3 cursor-pointer" @click="resend()">
                Wyślij kod ponownie
            </div>
        </div>
    </div>
</template>
<script>
import { mapState, mapActions } from 'vuex'
export default {
    name: 'changePassword',
    data() {
        return {
            form: {
                code: null,
                email: null,
                token: null
            },
            errors: []
        }
    },
    methods: {
        async save() {
            this.processing = true
            await this.$http.get('/sanctum/csrf-cookie').then(response => {
                this.$http.post(route('api.2fa.post'), {code: this.form.code, email: this.$store.state.auth.user.email}).then((response) => {
                    this.$store.commit('auth/SET_USER', response.data.data.user)
                    this.$store.dispatch('auth/logged')
                    this.$router.push({ name: response.data.data.route })
                }).catch((error) => {
                    console.log(error)
                    this.errors = error.data.data.errors
                }).finally(()=>{
                    this.processing = false
                })
            })
        },
        async resend() {
            this.processing = true
            await this.$http.get('/sanctum/csrf-cookie').then(response => {
                this.$http.post(route('api.2fa.resend'), {email: this.$store.state.auth.user.email})
                    .then((response) => {
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
