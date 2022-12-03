<template>
    <b-modal id="car-brand-modal" title="Dodaj Markę samochodu" size="lg" @shown="defaultForm()">
        <form>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col item">
                            Nazwa marki:
                            <div>
                                <div class="input__wrapper mt-1">
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        placeholder="Nazwa marki"
                                        class="form-control"
                                        :class="{invalid : errors.name}"
                                    >
                                    <error :errors="errors.name"></error>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col item">
                            Popularność marki:
                            <div>
                                <div class="input__wrapper mt-1">
                                    <v-select
                                        v-model="form.brand_popularity"
                                        :options="options"
                                        :reduce="option => option.value"
                                        placeholder="Wybierz popularność marki"
                                        :class="{invalid : errors.brand_popularity}"
                                    >
                                    </v-select>
                                    <error :errors="errors.brand_popularity"></error>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <template #modal-footer="{close}">
            <div class="w-100 justify-content-between d-flex">
                <button type="button" class="btn btn-warning me-4" @click="defaultForm"><i
                    class="fa fa-eraser pe-3"></i>
                    Wyczyść
                </button>
                <div>
                    <button type="button" class="btn btn-success" @click="btnUrl"><i class="fa fa-save pe-3"></i>
                        Zapisz
                    </button>
                    <button type="button" class="btn btn-danger" @click="close">
                        <i class="fa-solid fa-xmark pe-3"></i>
                        Anuluj
                    </button>
                </div>
            </div>
        </template>
    </b-modal>
</template>
<script>
import error from '../../../../../js/assets/form/error'

export default {
    components: {
        error
    },
    props: {
        data: {
            type: [Object, Array],
            default: () => {
            }
        },
        isEdit: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            form: this.data,
            errors: {},
            options: [
                {
                    label: 'popularna',
                    value: 0
                },
                {
                    label: 'mniej popularna',
                    value: 1
                },
                {
                    label: 'archiwalna',
                    value: 2
                }
            ]
        }
    },
    computed: {
        btnUrl() {
            return this.isEdit ? this.edit : this.save
        }
    },
    methods: {
        defaultForm() {
            if (this.isEdit) {
                this.form = this.data
            } else {
                this.form = {
                    name: null,
                    brand_popularity: null
                }
            }
        },
        save() {
            this.$http.post(route('admin.cars.brand.store'), this.form).then((response) => {
                this.$bvModal.hide('car-brand-modal')
                this.$nextTick(function () {
                    this.$emit('reload')
                })
            })
        },
        edit() {
            this.$http.put(route('admin.cars.brand.update', this.data.id), this.form).then((response) => {
                this.$bvModal.hide('car-brand-modal')
                this.is_edit = false
                this.$emit('reload')
            })
        }
    }
}
</script>
