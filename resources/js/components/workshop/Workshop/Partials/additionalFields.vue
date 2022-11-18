<template>
    <div class="mt-3">
        <h5>Dodatkowe pola</h5>
        <hr>
        <div class="row mt-3 align-items-baseline" v-for="(field, index) in form.fields">
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
                    >

                    </v-select>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Wartość pola">
                    <b-input v-model="field.value" type="text" laceholder="Wartość pola">

                    </b-input>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-12 px-3 mt-2 mb-2">
                <b-button variant="danger" @click="removeField(index)" v-if="index > 0">
                    <i class="fa fa-minus"></i>
                    Pole
                </b-button>
                <b-button variant="primary" @click="addField()" v-if="index === form.fields.length - 1">
                    <i class="fa fa-plus"></i>
                    Pole
                </b-button>
            </div>
            <hr>
        </div>
    </div>
</template>
<script>
export default {
    name: 'additionalFields',
    props: {
        fieldTypes: {
            type: [Object, Array],
            default: () => []
        }
    },
    data() {
        return {
            types: [],
            form: {
                fields: [
                    {
                        name: null,
                        type: null,
                        value: null
                    }
                ]
            }
        }
    },
    methods: {
        addField() {
            this.form.fields.push({
                name: null,
                type: null,
                value: null
            })
        },
        removeField(index) {
            this.form.fields.splice(index, 1)
        }
    }
}
</script>
