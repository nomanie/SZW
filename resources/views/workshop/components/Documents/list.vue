<template>
    <div>
        <datatable
            :table-id="`documents`"
            :server-side-data="true"
            :columns="fields"
            :scroll-x="false"
            :reload-table="reload_table"
            :modal-id="add_edit_modal_id"
            api-url="workshop.documents"
            delete-url="workshop.documents.destroy"
            @add="add"
            @delete="remove"
            @edit="edit($event, true)"
            @show="show"
            @download="download"
        >
        </datatable>
        <modal
            :data="data"
            @reload="reload_table++"
            :is-edit="isEdit"
        ></modal>
    </div>
</template>
<script>
import modal from './modal'
export default {
    components: {
        modal
    },
    data() {
        return {
            fields: [
                {
                    data: 'id',
                    name: 'id',
                    title: 'ID'
                },
                {
                    data: 'fv_number',
                    name: 'fv_number',
                    title: 'Numer Faktury'
                },
                {
                    data: 'sum_gross',
                    name: 'sum_gross',
                    title: 'Suma Brutto'
                },
                {
                    data: 'recipient_name',
                    name: 'recipient_name',
                    title: 'Nabywca'
                },
                {
                    data: 'action',
                    name: 'action',
                    title: '',
                    orderable: false,
                    className: 'not-exportable not-selectable',
                    exportable: false,
                    width: '10px'
                },
            ],
            reload_table: 0,
            add_edit_modal_id: 'client-documents-modal',
            data: {},
            isEdit: false
        }
    },
    computed: {
        getToken() {
            return localStorage.getItem('token')
        }
    },
    methods: {
        add() {
            this.$bvModal.show(this.add_edit_modal_id)
        },
        remove($event) {
            this.$http.delete(route('workshop.documents.destroy', {tenant: this.$store.state.auth.user.uuid, document: $event})).then((response) => {
                this.reload_table++
                this.$emit('table:reload')
            })
        },
        edit($event) {
            this.isEdit = true
            this.$http.get(route('workshop.documents.show', {tenant: this.$store.state.auth.user.uuid, document: $event})).then((response) => {
                this.data = response.data.data
                this.$bvModal.show(this.add_edit_modal_id)
            })
        },
        download($event) {
            this.$http.get(route('workshop.documents.token', {tenant: this.$store.state.auth.user.uuid})).then((res) => {
                window.location = route('workshop.documents.download_document', {tenant: this.$store.state.auth.user.uuid, document: $event}) + '?token=' + res.data.token
            })
        },
        show() {

        }
    }
}
</script>
