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
                api-url="admin.cars.brand.index"
                table-name="Tabela_marek_samochodów"
                delete-url="admin.cars.brand.destroy"
                @update="edit"
            >
            </datatable>
        </div>
    </div>
</template>
<script>
import modal from './modal'

export default {
    components: {
        modal,
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
                    data: 'name',
                    name: 'Marka',
                    title: 'Marka',
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
            this.$http.delete(route('admin.cars.brand.destroy', id)).then((response) => {
            }).catch((error) => {
            })
        },
        edit($event) {
            this.$http.get(route('admin.cars.brand.edit', $event)).then((response) => {
                this.data = response.data.data;
                this.isEdit = true
            })
        }
    }
}
</script>
