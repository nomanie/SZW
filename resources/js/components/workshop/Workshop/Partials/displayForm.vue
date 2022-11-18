<template>
    <div class="mt-3">
        <b-modal id="worker-modal" title="Dodaj nowego pracownika" size="lg" @shown="defaultForm(); getOptions()">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col item">
                            Imię pracownika:
                            <div>
                                <div class="input__wrapper mt-1">
                                    <input
                                        v-model="form.first_name"
                                        type="text"
                                        placeholder="Imię pracownika"
                                        class="form-control"
                                        :class="{invalid : errors.first_name}"
                                    >
                                    <error :errors="errors.first_name"></error>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col item">
                            Nazwisko pracownika:
                            <div>
                                <div class="input__wrapper mt-1">
                                    <input
                                        v-model="form.last_name"
                                        type="text"
                                        placeholder="Nazwisko pracownika"
                                        class="form-control"
                                        :class="{invalid : errors.last_name}"
                                    >
                                    <error :errors="errors.last_name"></error>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <template #modal-footer>
                <div class="w-100 justify-content-between d-flex">
                    <button type="button" class="btn btn-warning me-4" @click="defaultForm"><i
                        class="fa fa-eraser pe-3"></i>
                        Wyczyść
                    </button>
                    <div>
                        <button type="button" class="btn btn-success" @click="save"><i class="fa fa-save pe-3"></i>
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
export default {
    name: 'customForm',
    props: {
        form: {}
    }
}
</script>
