<template>
    <div>
        <div class="m-3 position-relative">
            <div class="mb-2">
                <router-link :to="{ name: 'workshop.clients' }"> Wróć do listy klientów</router-link>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <div class="d-flex">
                        <div class="avatar">
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-3">
                        <h3 class="mb-0">{{name}}</h3>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-outline-danger my-1" style="padding: 2px 10px">Usuń Klienta
                                </button>
                                <button class="btn btn-outline-success my-1" style="padding: 2px 10px">Dodaj zdjęcie
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex w-25">
                    <div class="tags w-100">
                        <b-form-group label="Tagi">
                            <v-select
                                multiple
                                taggable
                                push-tags
                            >
                                <template #open-indicator="{ attributes }">
                                    <span v-bind="attributes"></span>
                                </template>
                            </v-select>
                        </b-form-group>
                    </div>
                </div>
                <div class="d-flex"></div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <b-tabs content-class="mt-3" class="w-100">
                        <b-tab>
                            <template #title>
                                <router-link :to="{name: 'workshop.clients.data'}">
                                    <i class="fa-solid fa-address-card"></i>
                                    Dane klienta
                                </router-link>
                            </template>
                        </b-tab>
                        <b-tab @click="showned_tabs.push('cars')">
                            <template #title>
                                <router-link :to="{name: 'workshop.clients.cars'}">
                                    <i class="fa-solid fa-car"></i>
                                    Pojazdy
                                </router-link>
                            </template>
                        </b-tab>
                        <b-tab @click="showned_tabs.push('document-list')">
                            <template #title>
                                <router-link :to="{name: 'workshop.clients.documents'}">
                                    <i class="fa-solid fa-file"></i>
                                    Dokumenty
                                </router-link>
                            </template>
                        </b-tab>
                        <b-tab>
                            <template #title>
                                <i class="fa-solid fa-wrench"></i>
                                Zlecenia
                            </template>
                            <div class="text-center fs-20 my-3">
                                <i class="fa-solid fa-hammer"></i>
                                Prace trwają
                            </div>
                        </b-tab>
                        <b-tab>
                            <template #title>
                                <i class="fa-solid fa-book"></i>
                                Dziennik aktywności
                            </template>
                            <div class="text-center fs-20 my-3">
                                <i class="fa-solid fa-hammer"></i>
                                Prace trwają
                            </div>
                        </b-tab>
                    </b-tabs>
                    <router-view></router-view>
                </div>
            </div>
            <loader></loader>
        </div>
    </div>
</template>
<script>
import info from './tabs/info'
import loader from "@js/components/Loader";
import carsList from './tabs/cars/list'
import documentList from './tabs/documents/list'

export default {
    name: 'show',
    components: {
        loader,
        info,
        carsList,
        documentList
    },
    data() {
        return {
            showned_tabs: [],
            name: ''
        }
    },
    mounted() {
        console.log('test')
    },
    methods: {
        getName($event) {
            this.name = $event
        }
    }
}
</script>
<style scoped>
.avatar {
    width: 100px;
    height: 100px;
    border: solid 1px rgba(0, 0, 0, 0.3);
}
</style>
