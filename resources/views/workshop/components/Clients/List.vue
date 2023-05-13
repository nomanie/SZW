<template>
    <div class="mt-5">
        <datatable
            :table-id="`clients`"
            :server-side-data="true"
            :columns="fields"
            :reload-table="reload_table"
            :scroll-x="false"
            :modal-id="add_edit_modal_id"
            delete-url="workshop.clients.destroy"
            @add="add"
            @delete="remove"
            @edit="edit($event, true)"
            @show="show"
            api-url="workshop.clients"
        >
        </datatable>
        <modal
            :data="data"
            @reload="reload_table++"
        ></modal>
    </div>
</template>

<script>
import modal from './modal'
export default {
    name: 'List',
    components: {
        modal
    },
    data() {
        return {
            data: {},
            fields: [
                {
                    data: 'id',
                    name: 'id',
                    title: 'ID'
                },
                {
                    data: 'first_name',
                    name: 'first_name',
                    title: 'Imię'
                },
                {
                    data: 'last_name',
                    name: 'last_name',
                    title: 'Nazwisko'
                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'Adres e-mail'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    title: 'Nr. telefonu'
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
            add_edit_modal_id: 'clients-modal',
            isEdit: false,
        }
    },
    methods: {
        add($event) {
            this.$bvModal.show(this.add_edit_modal_id)
        },
        remove($event) {
            this.$http.delete(route('workshop.clients.destroy', {tenant: this.$store.state.auth.user.uuid, client: $event})).then((response) => {
                this.reload_table++
                this.$emit('table:reload')
            })
        },
        edit($event, edit = false) {
            this.isEdit = edit
            this.$http.get(route('workshop.clients.show', {tenant: this.$store.state.auth.user.uuid, client: $event})).then((response) => {
                this.data = response.data.data
                this.$bvModal.show(this.add_edit_modal_id)
            })
        },
        show($event) {
            this.$router.push({ name: 'workshop.clients.show', params: { id: $event } })
        }
    }
}
</script>
