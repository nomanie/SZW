<template>
    <div class="mt-3 px-3">
        <h5>Dodatkowe pola</h5>
        <hr>
        <div class="row mt-3 align-items-baseline" v-for="(field, index) in form.fields">
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Nazwa pola">
                    <b-input
                        type="text"
                        v-model="field.name"
                        placeholder="Nazwa pola"
                        :class="{invalid : errors[`fields.${index}.name`]}"
                    >
                    </b-input>
                    <error :errors="errors[`fields.${index}.name`]"></error>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Rodzaj pola">
                    <v-select
                        v-model="field.type"
                        placeholder="Wybierz rodzaj pola"
                        :options="fieldTypes"
                        :reduce="field => field.index"
                        :class="{invalid : errors[`fields.${index}.type`]}"
                    >
                    </v-select>
                    <error :errors="errors[`fields.${index}.type`]"></error>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Wartość pola">
                    <b-input
                        v-model="field.value"
                        type="text"
                        laceholder="Wartość pola"
                        :class="{invalid : errors[`fields.${index}.value`]}"
                    >
                    </b-input>
                    <error :errors="errors[`fields.${index}.value`]"></error>
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
    </div>
</template>
<script>
import error from "@js/assets/form/error";

export default {
    name: 'additionalFields',
    components: {
        error
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
            errors: {},
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
    watch: {
        form: {
            deep: true,
            immediate: true,
            handler(value) {
                this.$emit('update', this.form)
            }
        }
    },
    mounted() {
        if (this.data) {
            this.form.fields = this.data
        }
    },
    methods: {
        save() {
            this.form.section = 'additional_fields'
            this.$http.put(route('workshop.workshops.update', this.id), this.form).then(() => {

            })
        },
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
