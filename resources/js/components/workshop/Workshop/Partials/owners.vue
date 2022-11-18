<template>
    <div class="mt-3">
        <h5>Właściciele firmy</h5>
        <hr>
        <div class="row mt-3 align-items-baseline" v-for="(owner, index) in form.owners">
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Imię właściciela">
                    <b-input type="text" v-model="owner.first_name" placeholder="Imię właściciela">

                    </b-input>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-4 px-3">
                <b-form-group label="Nazwisko właściciela">
                    <b-input type="text" v-model="owner.last_name" placeholder="Nazwisko właściciela">

                    </b-input>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-4 px-3">
                <b-button variant="danger" @click="removeOwner(index)" v-if="index > 0">
                    <i class="fa fa-minus"></i>
                    właściciela
                </b-button>
                <b-button variant="primary" @click="addOwner()" v-if="index === form.owners.length - 1">
                    <i class="fa fa-plus"></i>
                    właściciela
                </b-button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'owners',
    data() {
        return {
            form: {
                owners: [
                    {
                        first_name: null,
                        last_name: null
                    }
                ]
            }
        }
    },
    methods: {
        addOwner() {
            this.form.owners.push({first_name: null, last_name: null})
        },
        removeOwner(index) {
            this.form.owners.splice(index, 1)
        }
    }
}
</script>
