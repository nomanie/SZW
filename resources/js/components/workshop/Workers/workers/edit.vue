<template>
    <div class="card-edit">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <div class="avatar">
                            <img src="../../../../../../public/images/person.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 card-header">
                <div>
                    {{ this.form.first_name }} {{ this.form.last_name }}
                    <div class="position">{{ this.form.position }}</div>
                </div>

                <button class="btn btn-primary">
                    <i class="fa fa-camera"></i>
                    Zmień zdjęcie
                </button>
            </div>
            <div class="col-12 col-lg-5 flex-column d-flex align-items-end">
                <div class="d-flex w-75 flex-column">
                    <button class="btn btn-warning">
                        <i class="fa fa-floppy-disk"></i>
                        Archiwizuj
                    </button>
                    <button class="btn btn-danger mt-2">
                        <i class="fa fa-trash"></i>
                        Usuń
                    </button>
                    <button class="btn btn-success mt-2">
                        <i class="fa fa-hammer"></i>
                        Przydziel zadanie
                    </button>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <b-tabs content-class="mt-3">
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-address-card"></i>
                        Informacje
                    </template>
                    <form class="mt-2">
                        <div class="row">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Imię">
                                    <input v-model="form.first_name" type="text" class="form-control" placeholder="Imię pracownika">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Nazwisko">
                                    <input v-model="form.last_name" type="text" class="form-control" placeholder="Nazwisko pracownika">
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Adres e-mail">
                                    <input v-model="form.email" type="text" class="form-control" placeholder="Adres e-mail pracownika">
                                </b-form-group>
                            </div>
                            <div class="col-12 col-lg-6 px-3">
                                <b-form-group label="Numer telefonu">
                                    <input v-model="form.phone" type="text" class="form-control" placeholder="Numer telefonu pracownika">
                                </b-form-group>
                            </div>
                        </div>
                    </form>
                </b-tab>
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-file-signature"></i>
                        Umowa
                    </template>
                </b-tab>
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-list-check"></i>
                        Przypisane zadania
                    </template>
                </b-tab>
                <b-tab>
                    <template #title>
                        <i class="fa-solid fa-calendar"></i>
                        Kalendarz
                    </template>
                </b-tab>
            </b-tabs>
        </div>
    </div>
</template>
<script>
export default {
    name: 'edit',
    props: {
        id: {
            type: Number,
            default: () => null
        }
    },
    data() {
        return {
            form: {}
        }
    },
    watch: {
        'form': {
            deep: true,
            handler(value) {
                this.$emit('update', value)
            }
        }
    },
    mounted() {
      this.getData()
    },
    methods: {
        getData() {
            this.$http.get(route('api.workers.show', this.id)).then((response) => {
                this.form = response.data
            }).catch((error) => {
                console.log(error)
            })
        }
    }
}
</script>
