<template>
    <div class="container mt-3">
        <div>
            <div class="d-flex justify-content-end">
            </div>
            <datatable
                :table-id="`car-brand-table`"
                :server-side-data="true"
                :columns="fields"
                :modal-id="modal_id"
                :reload-table="reload_table"
                :scroll-x="false"
                api-url="admin.cars.brand"
                @edit="showModal($event, true)"
                @show="showDetails($event)"
                @delete="remove"
                @add="add"
            >
            </datatable>
            <modal
                :data="data"
                :is-edit="isEdit"
                @reload="reload_table++"
            >

            </modal>
        </div>
    </div>
</template>
<script>
import modal from './modal'
import DataTables from "../../../../../js/components/dataTables";

export default {
    components: {
        DataTables,
        modal,
    },
    data() {
        return {
            modal_id: 'car-brand-modal',
            data: {},
            isEdit: false,
            reload_table: 0,
            fields: [
                {
                    data: 'id',
                    name: 'id',
                    title: 'ID'
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Marka'
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
            ]
        }
    },
    methods: {
        showModal($event, edit = false) {
            this.isEdit = edit
            this.$http.get(route('admin.cars.brand.edit', $event)).then((response) => {
                this.data = response.data.data
                this.$bvModal.show(this.modal_id)
            })

        },
        showDetails($event) {

        },
        remove($event) {
            this.$http.delete(route('admin.cars.brand.destroy', $event)).then((response) => {
                this.reload_table++
            })
        },
        add($event) {
            this.$bvModal.show(this.modal_id)
        }
    }
}
</script>
