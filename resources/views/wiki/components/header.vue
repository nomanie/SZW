<template>
    <div class="wiki__header">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-6 col-lg-2">
                    PocketCar Wiki Logo
                </div>
                <div class="col-6 col-lg-2">
                    <b-dropdown v-if="auth" class="m-md-2" text="Utwórz" variant="primary">
                        <b-dropdown-item>
                            <router-link to="/informations">
                                <span>Sekcje</span>
                            </router-link>
                        </b-dropdown-item>
                        <b-dropdown-item>
                            <router-link to="/settings">
                                <span>Moduł</span>
                            </router-link>
                        </b-dropdown-item>
                        <b-dropdown-item>
                            <router-link to="/workers">
                                <span>Wpis</span>
                            </router-link>
                        </b-dropdown-item>
                    </b-dropdown>
                </div>
                <div class="col-6 col-lg-4 d-flex justify-content-end align-items-center">
                    <div class="global-search me-4">
                        <div class="input__wrapper">
                            <input type="text" placeholder="Wyszukaj..." id="global-search-input">
                            <span class="underline-animation"></span>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <div v-if="auth" class="profile">
                        <img :src="img" height="40">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'wiki-header',
    props: {
        img: {
            type: String,
            default: () => null
        }
    },
    data() {
        return {
            auth: false
        }
    }
}
</script>
