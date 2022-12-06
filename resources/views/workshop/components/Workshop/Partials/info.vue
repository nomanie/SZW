<template>
    <form class="mt-2 mx-3">
        <h5>Podstawowe Dane</h5>
        <hr>
        <div class="row">
            <div class="col-12 col-lg-6 px-3">
                <b-form-group label="Nazwa firmy">
                    <b-input type="text" v-model="form.name" placeholder="Nazwa firmy">

                    </b-input>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-6 px-3">
                <b-form-group label="Data utworzenia firmy">
                    <b-input type="date" v-model="form.company_created_at"
                             placeholder="Data utworzenia firmy">

                    </b-input>
                </b-form-group>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-lg-6 px-3">
                <b-form-group label="REGON firmy">
                    <b-input type="text" v-model="form.regon" placeholder="REGON firmy">

                    </b-input>
                </b-form-group>
            </div>
            <div class="col-12 col-lg-6 px-3">
                <b-form-group label="NIP firmy">
                    <b-input type="text" v-model="form.nip" placeholder="NIP firmy">

                    </b-input>
                </b-form-group>
            </div>
        </div>
        <owners></owners>
        <div class="row">
            <div class="col-12">
                <hr class="mt-3">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-end px-3">
                <b-button variant="warning" class="mr-2">
                    <i class="fa fa-eraser"></i>
                    Cofnij zmiany
                </b-button>
                <b-button variant="success" @click="">
                    <i class="fa fa-floppy-disk"></i>
                    Zapisz
                </b-button>
            </div>
        </div>
    </form>
</template>
<script>
import owners from './owners'

export default {
    name: 'Information',
    components: {
        owners
    },
    data() {
        return {
            form: {},
        }
    },
}
</script>
