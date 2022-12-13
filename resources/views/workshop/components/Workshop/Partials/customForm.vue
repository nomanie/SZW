<template>
    <div class="mt-3 px-3">
        <h5>Formularz kontaktowy</h5>
        <hr>
        <v-select
            v-model="form.view"
            placeholder="Wybierz Wygląd formularza"
            :options="view_templates"
            :reduce="view => view.index"
        ></v-select>
        <hr>
        <div class="mt-3 align-items-baseline" v-for="(field, index) in form.fields">
            <div class="row">
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Nazwa pola">
                        <b-input type="text" v-model="field.name" placeholder="Nazwa pola">

                        </b-input>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Rodzaj pola">
                        <v-select
                            v-model="field.type"
                            placeholder="Wybierz rodzaj pola"
                            :options="fieldTypes"
                            :reduce="field => field.index"
                        >
                        </v-select>
                    </b-form-group>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Minimalna długość">
                        <b-input v-model="field.min" type="number" laceholder="Minimalna długość">

                        </b-input>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Maksymalna długość">
                        <b-input v-model="field.max" type="number" laceholder="Maksymalna długość">

                        </b-input>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Pole wymagane">
                        <b-form-checkbox v-model="field.required">

                        </b-form-checkbox>
                    </b-form-group>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 px-3 mt-2 mb-2">
                    <b-button variant="danger" @click="removeField(index)" v-if="index > 0">
                        <i class="fa fa-minus"></i>
                        Pole
                    </b-button>
                    <b-button variant="primary" @click="addField()" v-if="index === form.fields.length - 1">
                        <i class="fa fa-plus"></i>
                        Pole
                    </b-button>
                    <b-button variant="success" @click="setDefaultForm()" v-if="index === form.fields.length - 1">
                        <i class="fa fa-arrow-up"></i>
                        Ustaw domyślny formularz
                    </b-button>
                    <b-button variant="secondary" @click="display()" v-if="index === form.fields.length - 1">
                        <i class="fa-regular fa-eye"></i>
                        Podgląd
                    </b-button>
                </div>
                <hr>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-end px-3">
                <b-button variant="warning" class="mr-2">
                    <i class="fa fa-eraser"></i>
                    Cofnij zmiany
                </b-button>
                <b-button variant="success" @click="save()">
                    <i class="fa fa-floppy-disk"></i>
                    Zapisz
                </b-button>
            </div>
        </div>
        <display-form :form="form.fields"></display-form>
    </div>
</template>
<script>
import displayForm from "./displayForm"
export default {
    name: 'customForm',
    components: {
        displayForm
    },
    props: {
        fieldTypes: {
            type: [Object, Array],
            default: () => []
        },
        data: {
            type: [Object, Array],
            default: () => []
        },
        id: {
            type: Number,
            default: () => null
        },
    },
    data() {
        return {
            types: [],
            form: {
                fields: [
                    {
                        name: null,
                        type: null,
                        required: false,
                        min: 0,
                        max: 0
                    }
                ],
                view: null,
            },
            view_templates: [
                {index: 0, label: 'Klasyczne'},
                {index: 1, label: 'Nowoczesne'},
                {index: 2, label: 'Wymyślne'},
            ]
        }
    },
    mounted() {
        if (this.data) {
            this.form = this.data
        }
    },
    watch: {
        form: {
            deep: true,
            immediate: true,
            handler(value) {
                this.$emit('update', this.form)
            }
        }
    },
    methods: {
        save() {
            this.form.section = 'contact_form'
            this.$http.put(route('workshop.workshops.update', this.id), this.form).then(() => {

            })
        },
        addField() {
            this.form.fields.push({
                name: null,
                type: null,
                required: false,
                min: 0,
                max: 0
            })
        },
        removeField(index) {
            this.form.fields.splice(index, 1)
        },
        setDefaultForm() {
            this.form.fields = [
                {
                    name: 'Adres e-mail',
                    type: 2,
                    required: true,
                    min: 5,
                    max: 0
                },
                {
                    name: 'Imię i Nazwisko',
                    type: 2,
                    required: true,
                    min: 6,
                    max: 0
                },
                {
                    name: 'Treść wiadomości',
                    type: 3,
                    required: true,
                    min: 0,
                    max: 0
                }
            ]
        },
        display() {
            this.$bvModal.show('display_form_modal')
        }
    }
}
</script>
<!-- @todo dorobić wyglady formularza-->
