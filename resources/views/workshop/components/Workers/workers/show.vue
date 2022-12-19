<template>
    <b-modal size="fs" title="Szczegóły pracownika" :id="modal_id" hide-footer>
        <template #modal-header>
        </template>
        <template #default>

        </template>
    </b-modal>
</template>
<script>
export default {
    name: 'show',
    props: {
        data: {
            type: [Object, Array],
            default: () => {}
        }
    },
    data() {
        return {
            modal_id: 'worker-info-modal',
            form: this.data
        }
    }
}
</script>
