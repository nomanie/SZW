<template>
    <div class="mt-3">
        <b-modal id="display_form_modal" title="Podgląd formularza" size="lg" @shown="getFieldTypes">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row mt-3" v-for="item in form">
                        <div class="col item">
                            {{ item.name }}
                            <div>
                                <div class="input__wrapper mt-1">
                                    <input
                                        :type="fieldTypes[item.type]"
                                        :placeholder="item.name"
                                        class="form-control"
                                        v-if="item.type !== 3"
                                    >
                                    <textarea
                                        v-else
                                        :placeholder="item.name"
                                        class="form-control"
                                    >
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <template #modal-footer>
                <div class="w-100 justify-content-between d-flex">
                    <button type="button" class="btn btn-danger" @click="hide">
                        <i class="fa-solid fa-xmark pe-3"></i>
                        Zamknij
                    </button>
                </div>
            </template>
        </b-modal>
    </div>
</template>
<script>
export default {
    name: 'displayForm',
    props: {
        form: {},
    },
    data() {
        return {
            fieldTypes: [],
            fields: this.form
        }
    },
    methods: {
        hide() {
            this.$bvModal.hide('display_form_modal');
        },
        getFieldTypes() {
            this.$http.get(route('api.get.options', {enum: 'App\\Enums\\Workshop\\FieldTypeEnum', function: 'getType'})).then((response) => {
                this.fieldTypes = response.data
            })
        }
    }
}
</script>
