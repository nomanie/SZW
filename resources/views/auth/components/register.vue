<template>
    <div class="container mt-5 login">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Jakie konto chcesz stworzyć</h1>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <router-link class="col-12 col-lg-3 account-type" :to="{ name: 'register.workshop' }">
                <img src="/images/workshop_register_img.jpg">
                <div class="account-type__text">
                    Konto dla Warsztatu
                </div>
            </router-link>
            <router-link class="col-12 col-lg-3 account-type" :to="{ name: 'register.client' }">
                <img src="/images/client_register_image.jpg">
                <div class="account-type__text">
                    Standardowe konto użytkownika
                </div>
            </router-link>
        </div>
        <div class="row mt-5 text-center">
            <div class="col-12">
                <h4>Masz już konto?</h4>
            </div>
        </div>
        <div class="row mt-2 text-center">
            <div class="col-12">
                <router-link :to="{ name: 'login' }">
                    <button class="btn btn-primary">
                        Zaloguj się
                    </button>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'register',

}
</script>
