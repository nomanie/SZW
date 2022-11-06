<template>
    <div>

        <b-modal id="worker-add" title="Dodaj nowego pracownika">
            <template #modal-footer="{ ok, cancel, hide }">
                <b-button size="md" variant="success" @click="ok()">
                    Dodaj
                </b-button>
                <b-button size="md" variant="danger" @click="cancel()">
                    Anuluj
                </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>

export default {
    data(){
        return {
            modalShow: true
        }
    }
}
</script>
