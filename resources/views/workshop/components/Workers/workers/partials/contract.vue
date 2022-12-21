<template>
    <div>
        <p>Umowa</p>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Zatrudniony do:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.contract_to"
                                    type="date"
                                    class="form-control"
                                    :class="{invalid : errors.contract_to}"
                                >
                                <error :errors="errors.contract_to"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Zatrudniony od:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.contract_from"
                                    type="date"
                                    class="form-control"
                                    :class="{invalid : errors.contract_from}"
                                >
                                <error :errors="errors.contract_from"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Stanowisko:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.position"
                                    type="text"
                                    placeholder="Stanowisko"
                                    class="form-control"
                                    :class="{invalid : errors.position}"
                                >
                                <error :errors="errors.position"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Typ umowy:
                        <div>
                            <div class="input__wrapper mt-1">
                                <v-select
                                    v-model="form.contract_type"
                                    :options="options"
                                    :class="{invalid : errors.contract_type}"
                                    placeholder="Wybierz rodzaj umowy"
                                >
                                </v-select>
                                <error :errors="errors.contract_type"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Pensja:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.salary"
                                    type="text"
                                    placeholder="np. 3650,50"
                                    class="form-control"
                                    :class="{invalid : errors.salary}"
                                >
                                <error :errors="errors.salary"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        <b-tabs>
                            <b-tab>
                                <template #title>
                                    Zakończone umowy
                                </template>

                            </b-tab>
                        </b-tabs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import error from '@js/assets/form/error'

export default {
    name: 'contract',
    components: {
        error
    },
    props: {
        data: {
            type: [Array, Object],
            default: () => {}
        }
    },
    data() {
        return {
            form: {},
            errors: {},
            options: []
        }
    },
    mounted() {
        this.getOptions()
    },
    watch: {
        data: function() {
            this.form = this.data
        }
    },
    methods: {
        get() {

        },
        save() {

        },
        getOptions() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\Workshop\\ContractTypeEnum'})).then((response) => {
                this.options = response.data
            })
        }
    }
}
</script>
