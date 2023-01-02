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
                :modal-id="add_edit_modal_id"
                table-id="car-brand-table"
                api-url="workshop.workers"
                table-name="Tabela_pracowników"
                delete-url="workshop.workers.destroy"
                @delete="remove"
                @add="add"
                @edit="edit($event, true)"
                @show="show"
            >
            </datatable>
        </div>
    </div>
</template>
<script>

import modal from './modal'
import TaskList from "../../../../../js/assets/task_list/TaskList";
import edit from './edit'
import show from './show'

export default {
    components: {
        TaskList,
        modal,
        edit,
        show
    },
    data() {
        return {
            add_edit_modal_id: 'worker-modal',
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
        add($event) {
            this.$bvModal.show(this.add_edit_modal_id)
        },
        edit($event, edit = false) {
            this.isEdit = edit
            this.$http.get(route('workshop.workers.show', $event)).then((response) => {
                this.data = response.data.data
                this.$bvModal.show(this.add_edit_modal_id)
            })

        },
        show($event) {
            this.$router.push({ name: 'workers.show', params: { id: $event } })
        }
    }
}
</script>
