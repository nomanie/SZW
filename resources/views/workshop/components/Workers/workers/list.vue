<template>
    <div class="container mt-3">
        <div>
            <div class="d-flex justify-content-end">
                <modal
                    :data="data"
                    @reload="reload_table++"
                ></modal>
            </div>
            <datatable
                :reload-table="reload_table"
                :columns="fields"
                :server-side-data="true"
                :modal-id="modal_id"
                table-id="car-brand-table"
                api-url="workshop.workers"
                table-name="Tabela_pracowników"
                delete-url="workshop.workers.destroy"
                @update="edit"
                @delete="remove"
                @add="add"
                @edit="showModal($event, true)"
            >
            </datatable>
        </div>
    </div>
</template>
<script>

import modal from './modal'
import TaskList from "../../../../../js/assets/task_list/TaskList";
import edit from './edit'

export default {
    components: {
        TaskList,
        modal,
        edit
    },
    data() {
        return {
            modal_id: 'worker-modal',
            data: {},
            reload_table: 0,
            fields: [
                {
                    data: 'id',
                    name: 'ID',
                    title: 'ID',
                },
                {
                    name: 'first_name',
                    title: 'Imię',
                    data: 'first_name',
                },
                {
                    name: 'last_name',
                    title: 'Nazwisko',
                    data: 'last_name',
                },
                {
                    name: 'login',
                    title: 'Login',
                    data: 'login',
                },
                {
                    name: 'position',
                    title: 'Stanowisko',
                    data: 'position',
                },
                {
                    name: 'contract_from',
                    title: 'Umowa od',
                    data: 'contract_from',
                    class: 'no-word-break'
                },
                {
                    name: 'contract_to',
                    title: 'Umowa do',
                    data: 'contract_to',
                    class: 'no-word-break'
                },
                {
                    name: 'contract_type',
                    title: 'Rodzaj umowy',
                    data: 'contract_type',
                },
                {
                    name: 'salary',
                    title: 'Wynagrodzenie',
                    data: 'salary',
                },
                {
                    data: 'action',
                    name: 'action',
                    title: '',
                    exportable: false,
                    orderable: false,
                    className: 'not-exportable not-selectable',
                }
            ]
        }
    },
    methods: {
        remove($event) {
            this.$http.delete(route('workshop.workers.destroy', $event)).then((response) => {
                this.reload_table++
            })
        },
        edit($event) {
            this.$http.get(route('workshop.workers.show', $event)).then((response) => {
                this.data = response.data.data;
                this.isEdit = true
            })
        },
        add($event) {
            this.$bvModal.show(this.modal_id)
        },
        showModal($event, edit = false) {
            this.isEdit = edit
            this.$http.get(route('admin.cars.brand.edit', $event)).then((response) => {
                this.data = response.data.data
                this.$bvModal.show(this.modal_id)
            })

        },
    }
}
</script>
