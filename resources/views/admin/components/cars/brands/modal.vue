<template>
    <div>
        <div class="btn btn-primary fs-10" @click="$bvModal.show('car-brand-modal'); defaultForm()">
            <i class="fa fa-plus me-2"></i>
            Markę samochodu
        </div>
        <b-modal id="car-brand-modal" title="Dodaj Markę samochodu" size="lg">
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
            <template #modal-footer>
                <div class="w-100 justify-content-between d-flex">
                    <button type="button" class="btn btn-warning me-4" @click="defaultForm"><i class="fa fa-eraser pe-3"></i>
                        Wyczyść
                    </button>
                    <div>
                        <button type="button" class="btn btn-success" @click="btnUrl"><i class="fa fa-save pe-3"></i>
                            Zapisz
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark pe-3"></i>
                            Anuluj
                        </button>
                    </div>
                </div>
            </template>
        </b-modal>
    </div>
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
            default: () => {}
        }
    },
    data() {
        return {
            modalShow: true,
            form: this.data,
            is_edit: false,
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
    watch: {
      data: function() {
          this.form = this.data
          this.is_edit = true
          this.$bvModal.show('car-brand-modal')
      }
    },
    computed: {
        btnUrl() {
            return this.is_edit ? this.edit : this.save
        }
    },
    methods: {
        defaultForm() {
            this.form = {
                name: null,
                brand_popularity: null
            }
        },
        save() {
            this.$http.post(route('admin.cars.brand.store'), this.form).then((response) => {
                this.$bvModal.hide('car-brand-modal')
                this.$nextTick(function() {
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
