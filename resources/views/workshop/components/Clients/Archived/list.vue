<template>
    <div class="mt-5">
        <datatable
            :table-id="`archived_clients`"
            :server-side-data="true"
            :columns="fields"
            :reload-table="reload_table"
            :scroll-x="false"
            :modal-id="add_edit_modal_id"
            :hide-add-record="true"
            delete-url="workshop.archived_clients.destroy"
            @delete="remove"
            @restore="restore($event)"
            api-url="workshop.archived_clients"
        >
        </datatable>
    </div>
</template>

<script>

export default {
    name: 'List',
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
        remove($event) {
            this.$http.delete(route('workshop.archived_clients.destroy', $event)).then((response) => {
                this.reload_table++
            })
        },
        restore($event) {
            this.$http.put(route('workshop.archived_clients.update', $event)).then((response) => {
                this.reload_table++
                this.$emit('table:reload')
            })
        }
    }
}
</script>
