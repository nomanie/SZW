<template>
    <div class="container mt-5 login">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img :src="img" height="120">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-center text">
                            Zaloguj się
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-center">
                            <div>
                                <label for="login">Adres e-mail</label>
                                <input v-model="form.email" type="email" class="form-control" placeholder="Adres e-mail">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-center">
                            <div>
                                <label for="password">Hasło</label>
                                <input v-model="form.password" type="password" class="form-control" placeholder="Hasło">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-center">
                            <div>
                                <button class="btn btn-primary" type="submit">Zaloguj się</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 d-flex justify-content-center">
                            <p>Nie masz jeszcze konta?</p>
                        </div>
                    </div>
                </form>
                <div class="row mt-2">
                    <div class="col-12 d-flex justify-content-center">
                        <a href="">
                            <button class="btn btn-warning" >Zarejestruj się</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'login',
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
                password: null
            }
        }
    },
    mounted() {
        if (this.verified) {
            this.$bvToast.toast('Adres e-mail został potwierdzony', {
                title: 'Komunikat', variant: 'success', toaster: 'b-toaster-top-center'
            })
        }
    }
}
</script>
