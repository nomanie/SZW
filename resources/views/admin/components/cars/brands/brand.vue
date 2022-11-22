<template>
    <div class="container mt-3">
        <div v-if="!is_edit">
            <div class="d-flex justify-content-end">
                <modal
                @save="getData"
                ></modal>
            </div>
            <datatable
                :reload="reload_table"
                :table-id="`car-brand-table`"
                :api-url="apiUrl"
                :columns="fields"
                table-name="Tabela_marek_samochodów"
                delete-url="admin.cars.brand.destroy"
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
            apiUrl: route('admin.cars.brand.index'),
            selected: [],
            is_edit: false,
            id: null,
            table: null,
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
                    className: 'not-exportable'
                }
            ]
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            this.$http.get(route('admin.cars.brand.index')).then((response) => {
                this.table = response.data
                this.reloadTable++
            }).catch((error) => {

            })
        },
        remove(id) {
            this.$http.delete(route('Admin.cars.brand.destroy', id)).then((response) => {
                this.getData()
            }).catch((error) => {
            })
        },
        edit(id) {
            this.id = id
            this.is_edit = true
        },
        //zrobić mixina do vueTable
        // setPage(page = 1)
        // {
        //     this.table.current_page = page
        // },
        // nextPage() {
        //     if(this.table.current_page < this.table.last_page) {
        //         this.table.current_page++
        //     }
        // },
        // prevPage() {
        //     if(this.table.current_page > this.table.from) {
        //         this.table.current_page--
        //     }
        // }
    }
}
</script>
