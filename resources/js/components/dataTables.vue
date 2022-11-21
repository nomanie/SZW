<template>
    <table class="table table-bordered yajra-datatable" :id="tableId">
        <thead>
        <tr>
            <th v-for="column in columns">
                {{ column.title }}
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="item in table" :key="item.id">
                <td v-for="field in item"> {{ field }}</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import "datatables.net-bs4/js/dataTables.bootstrap4";
import "datatables.net-bs4/css/dataTables.bootstrap4.css";
import $ from "jquery";
export default {
    name: 'dataTables',
    components: {

    },
    props: {
        tableId: {
            Type: String,
            default: () => null
        },
        columns: {
            Type: [Array, Object],
            default: () => null
        },
        apiUrl: {
            Type: String,
            default: () => null
        },
        table: {
            Type: [Array, Object],
            default: () => null
        }
    },
    data(){
        return {
            data: this.table
        }
    },
    mounted() {
        this.getData()
        $("#" + this.tableId).DataTable({
            data: this.table,
            processing: true,
            serverSide: false,
            ajax: this.apiUrl ,
            columns: this.columns
        })
    },
    methods: {
        getData() {
            if (this.apiUrl !== null) {
                this.$http.get(this.apiUrl).then((response) => {
                    this.data = response.data
                })
            }
        }
    }
}
</script>
