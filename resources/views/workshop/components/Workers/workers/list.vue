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
                table-id="car-brand-table"
                api-url="api.workshop.workers.index"
                table-name="Tabela_pracowników"
                delete-url="api.workshop.workers.destroy"
                @update="edit"
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
            data: {},
            reload_table: 0,
            fields: [
                {
                    data: 'id',
                    name: 'ID',
                    title: 'ID',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'first_name',
                    sortField: 'first_name',
                    title: 'Imię',
                    data: 'first_name',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'last_name',
                    sortField: 'last_name',
                    title: 'Nazwisko',
                    data: 'last_name',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'login',
                    sortField: 'login',
                    title: 'Login',
                    data: 'login',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'position',
                    sortField: 'position',
                    title: 'Stanowisko',
                    data: 'position',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'contract_from',
                    sortField: 'contract_from',
                    title: 'Umowa od',
                    data: 'contract_from',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'contract_to',
                    sortField: 'contract_to',
                    title: 'Umowa do',
                    data: 'contract_to',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'contract_type',
                    sortField: 'contract_type',
                    title: 'Rodzaj umowy',
                    data: 'contract_type',
                    visible: true,
                    className: 'exportable'
                },
                {
                    name: 'salary',
                    sortField: 'salary',
                    title: 'Wynagrodzenie',
                    data: 'salary',
                    visible: true,
                    className: 'exportable'
                },
                {
                    data: 'action',
                    name: 'Akcje',
                    title: 'Akcje',
                    visible: true,
                    className: 'not-exportable not-selectable',
                    render: function(data, type, row, meta) {
                        return '<button data-row_id="' + row.id + '" class="btn btn-success btn-edit mx-1 fs-12">Edytuj</button>' +
                            '<button data-row_id="' + row.id + '" class="btn btn-danger btn-delete mx-1 fs-12">Usuń</button>';
                    }
                }
            ]
        }
    },
    methods: {
        remove(id) {
            this.$http.delete(route('api.workshop.workers.destroy', id)).then((response) => {
            }).catch((error) => {
            })
        },
        edit($event) {
            this.$http.get(route('api.workshop.workers.show', $event)).then((response) => {
                this.data = response.data.data;
                this.isEdit = true
            })
        }
    }
}
</script>
