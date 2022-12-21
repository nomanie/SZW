<template>
    <div>
        <div class="card-edit m-3 position-relative">
            <div class="row justify-content-between">
                <div class="d-flex flex-column mx-3">
                    <h3 class="mb-0">{{ fullName }}</h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="rounded-pill bg-warning fs-12 px-2">Na urlopie</div>
                        </div>
                        <div>
                            <div class="text-right">({{ form.position }})</div>
                        </div>
                    </div>

                </div>
                <div class="d-flex">
                    <div class="d-flex flex-column fs-16 mx-3 align-items-start">
                        <div>
                            Przypisane zadania: 12
                        </div>
                        <div>
                            Zakończone zadania: 105
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-3 fs-16">
                        <button class="btn btn-outline-danger mb-2" @click="destroy()">Usuń pracownika</button>
                        <button class="btn btn-outline-success">Zresetuj hasło</button>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <b-tabs content-class="mt-3" class="w-100">
                        <b-tab>
                            <template #title>
                                <i class="fa-solid fa-address-card"></i>
                                Dane pracownika
                            </template>
                            <div>
                                <info
                                    :data="form"
                                    @reset="get()"
                                ></info>
                            </div>
                        </b-tab>
                        <b-tab>
                            <template #title>
                                <i class="fa-solid fa-file-circle-check"></i>
                                Umowa
                            </template>
                            <div>
                                <contract
                                    :data="form"
                                    @reset="get()"
                                ></contract>
                            </div>
                        </b-tab>
                        <b-tab>
                            <template #title>
                                <i class="fa-solid fa-user-lock"></i>
                                Uprawnienia
                            </template>
                            <div>
                                Przypisane zadania
                            </div>
                        </b-tab>
                        <b-tab>
                            <template #title>
                                <i class="fa-solid fa-wrench"></i>
                                Przypisane zadania
                            </template>
                            <div>
                                Dziennik aktywności
                            </div>
                        </b-tab>
                        <b-tab>
                            <template #title>
                                <i class="fa-solid fa-book"></i>
                                Dziennik aktywności
                            </template>
                            <div>
                                Uprawnienia
                            </div>
                        </b-tab>
                    </b-tabs>
                </div>
            </div>
            <loader></loader>
        </div>
    </div>
</template>
<script>
import loader from "@js/components/Loader";
import info from "@workshop/Workers/workers/partials/info"
import contract from "@workshop/Workers/workers/partials/contract"

export default {
    name: 'show',
    components: {
        loader,
        info,
        contract
    },
    props: {},
    computed: {
        fullName() {
            return this.form.first_name + ' ' + this.form.last_name;
        }
    },
    data() {
        return {
            form: {},
            id: this.$route.params.id
        }
    },
    mounted() {
        this.get()
    },
    methods: {
        get() {
            this.$http.get(route('workshop.workers.show', this.id)).then((res) => {
                this.form = res.data.data
                console.log(this.form)
            })
        },
        destroy() {
            this.$bvModal.msgBoxConfirm("Czy na pewno chcesz usunąć pracownika?", {
                title: 'Potwierdzenie',
                size: 'md',
                buttonSize: 'md',
                okVariant: 'danger',
                cancelVariant: 'outline-success',
                okTitle: 'Tak',
                cancelTitle: 'Nie',
                footerClass: 'p-2',
                noCloseOnBackdrop: true
            })
                .then(value => {
                    if (!value) {
                        return
                    }
                    this.$http.delete(route('workshop.workers.destroy', this.id))
                    this.$router.push({name: 'workers'})
                })
                .catch(err => {

                })
        }
    }
}
</script>
