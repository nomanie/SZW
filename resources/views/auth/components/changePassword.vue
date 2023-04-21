<template>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="row mt-5">
            <div class="col-12">
                <h2>Zmień hasło, aby się zalogować</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <input v-model="form.password" class="form-control mb-2 mt-4 w-100" type="password" name="password" placeholder="Wpisz hasło">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <input v-model="form.password_confirmation" class="form-control w-100" type="password" name="password_confirmation" placeholder="Ponownie wpisz hasło">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 mt-2">
                <button class="btn btn-primary w-100" @click="save()">Zmień hasło</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'changePassword',
    data() {
        return {
            form: {
                password: null,
                password_confirmation: null,
                email: null,
                token: null
            }
        }
    },
    methods: {
        async save() {
            this.processing = true
            await this.$http.get('/sanctum/csrf-cookie').then(response => {
                this.$http.post(route('api.password.reset', {token : this.form.token})).then((response) => {
                    console.log(response)
                })
            })
        }
    }
}
</script>
