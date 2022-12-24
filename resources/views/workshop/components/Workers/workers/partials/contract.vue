<template>
    <div>
        <p v-if="!new_contract">Aktualna umowa</p>
        <p v-else>Nowa umowa</p>
        <div class="row mt-3">
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
                                    :disabled="disabled"
                                >
                                <error :errors="errors.contract_from"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    :disabled="disabled || form.for_indefined_period"
                                >
                                <error :errors="errors.contract_to"></error>
                            </div>
                            <b-checkbox v-model="form.for_indefined_period" v-if="!disabled" class="mt-1"">Na czas nieokreślony</b-checkbox>
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
                                    :disabled="disabled"
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
                                    :disabled="disabled"
                                    :reduce="item => item.id"
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
                                    :disabled="disabled"
                                >
                                <error :errors="errors.salary"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-end">
                <div class="row">
                    <div class="col item">
                        <div>
                            <div class="input__wrapper mt-1">
                                <button v-if="disabled" class="btn btn-primary" @click="generate">Generuj nową umowę
                                </button>
                                <button v-if="disabled" class="btn btn-warning" @click="disabled = false">Edytuj umowę
                                </button>
                                <button v-if="!disabled" class="btn btn-success" @click="save">Zapisz umowę
                                </button>
                                <button v-if="new_contract || !disabled" class="btn btn-warning" @click="cancel">
                                    Anuluj
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-12 col-md-12">
                <div class="row">
                    <div class="col item">
                        <b-tabs>
                            <b-tab>
                                <template #title>
                                    Zakończone umowy
                                </template>
                                <datatable
                                    :table-id="`worker-contracts`"
                                    :server-side-data="true"
                                    :columns="fields"
                                    :reload-table="reload_table"
                                    :scroll-x="false"
                                    :hide-add-record="true"
                                    :hide-delete="true"
                                    api-url="workshop.workers.contracts"
                                >
                                </datatable>
                                <!--                                    @edit="showModal($event, true)"-->
                                <!--                                    @show="showDetails($event)"-->
                                <!--                                    @delete="remove"-->
                                <!--                                    @add="add"-->
                            </b-tab>
                            <b-tab>
                                <template #title>
                                    Zaplanowane umowy
                                </template>
                                <div class="text-center fs-20 my-3">
                                    <i class="fa-solid fa-hammer"></i>
                                    W budowie
                                </div>
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
            default: () => {
            }
        }
    },
    data() {
        return {
            form: {},
            errors: {},
            options: [],
            disabled: true,
            new_contract: false,
            worker_id: this.$route.params.id,
            fields: [
                {
                    data: 'id',
                    name: 'id',
                    title: 'ID'
                },
                {
                    data: 'position',
                    name: 'position',
                    title: 'Stanowisko'
                },
                {
                    data: 'salary',
                    name: 'salary',
                    title: 'Pensja'
                },
                {
                    data: 'contract_from',
                    name: 'contract_from',
                    title: 'Umowa od'
                },
                {
                    data: 'contract_to',
                    name: 'contract_to',
                    title: 'Umowa do'
                },
                {
                    data: 'contract_type',
                    name: 'contract_type',
                    title: 'Rodzaj umowy'
                },
                {
                    data: 'archived_at',
                    name: 'archived_at',
                    title: 'Zarchiwizowano'
                },
                {
                    data: 'action',
                    name: 'action',
                    title: '',
                    orderable: false,
                    className: 'not-exportable not-selectable',
                    exportable: false,
                    width: '10px'
                },
            ],
            reload_table: 0,
        }
    },
    mounted() {
        this.form = this.data
        this.getOptions()
    },
    watch: {
        'form.for_indefined_period': function() {
            if (this.form.for_indefined_period) {
                this.form.contract_to = null;
            }
        },
    },
    methods: {
        cancel() {
            this.$emit('reset')
            this.disabled = true;
            this.new_contract = false;
            this.form = this.data
        },
        save() {
            this.disabled = true
            let data = this.form
            data['worker_id'] = this.worker_id
            if (this.new_contract) {
                this.$http.post(route('workshop.workers.contracts.store'), data).then((res) => {
                    this.reload_table++
                })
            } else {
                this.$http.put(route('workshop.workers.contracts.update', this.form.contract_id), data)
            }
            this.new_contract = false
        },
        defaultForm() {
            this.form = {
                contract_from: null,
                contract_to: null,
                contract_type: null,
                salary: null,
                position: null,
                for_indefined_period: false
            }
        },
        getOptions() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\Workshop\\ContractTypeEnum'})).then((response) => {
                this.options = response.data
            })
        },
        generate() {
            this.defaultForm()
            this.disabled = false
            this.new_contract = true
            console.log(this.form)
        }
    }
}
</script>
