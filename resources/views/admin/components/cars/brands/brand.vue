<template>
    <div class="container mt-3">
        <div v-if="!is_edit">
            <div class="d-flex justify-content-end">
                <modal></modal>
            </div>
            <datatable
                :table-id="`car-brand-table`"
                :api-url="apiUrl"
                :columns="fields"
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
            fields: [
                {
                    data: 'checkboxes',
                    name: ''
                },
                {
                    data: 'id',
                    name: 'ID'
                },
                {
                    data: 'name',
                    name: 'Marka'
                },
                {
                    data: 'action',
                    name: 'Akcje'
                }
            ]
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            this.$http.get(route('Admin.cars.brand.index')).then((response) => {
                this.table = response.data
                console.log(this.table)
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
