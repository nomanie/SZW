<template>
    <div class="mt-3">
        <h5>Właściciele firmy</h5>
        <hr>
        <div class="row mt-3 align-items-baseline" v-for="(owner, index) in form">
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Imię właściciela">
                    <b-input
                        type="text"
                        v-model="owner.first_name"
                        placeholder="Imię właściciela"
                        :class="{invalid : errors[`owners.${index}.first_name`]}"
                    >
                    </b-input>
                    <error :errors="errors[`owners.${index}.first_name`]"></error>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Nazwisko właściciela">
                    <b-input
                        type="text"
                        v-model="owner.last_name"
                        placeholder="Nazwisko właściciela"
                        :class="{invalid : errors[`owners.${index}.last_name`]}"
                    >
                    </b-input>
                    <error :errors="errors[`owners.${index}.last_name`]"></error>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-4 px-3">
                <b-button variant="danger" @click="removeOwner(index)" v-if="index > 0">
                    <i class="fa fa-minus"></i>
                    właściciela
                </b-button>
                <b-button variant="primary" @click="addOwner()" v-if="index === form.length - 1">
                    <i class="fa fa-plus"></i>
                    właściciela
                </b-button>
            </div>
        </div>
    </div>
</template>
<script>
import error from '@js/assets/form/error'
export default {
    name: 'owners',
    components: {
        error
    },
    props: {
        data: {
            type: Array,
            default: () => []
        },
        errors: {
            type: [Object, Array],
            default: () => {}
        }
    },
    data() {
        return {
            form: [
                {
                    first_name: null,
                    last_name: null
                }
            ]
        }
    },
    watch: {
        form: {
            deep: true,
            immediate: true,
            handler(value) {
                this.$emit('update', this.form)
            }
        },
    },
    mounted() {
        if (this.data) {
            this.form = this.data
        }
    },
    methods: {
        addOwner() {
            this.form.push({first_name: null, last_name: null})
        },
        removeOwner(index) {
            this.form.splice(index, 1)
        }
    }
}
</script>
