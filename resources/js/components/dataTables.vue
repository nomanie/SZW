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
import "datatables.net-buttons-dt";
import "datatables.net-buttons/js/buttons.print.js";
import "datatables.net-buttons/js/buttons.html5.js";
import "datatables.net-buttons/js/buttons.colVis.js";
import "datatables.net-colreorder-dt";
import "datatables.net-responsive-dt";
import "datatables.net-scroller-dt";
import "datatables.net-select-dt";
import "datatables.net-fixedheader-dt";
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
import "jszip";
import $ from "jquery";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
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
        },
        perPage: {
            Type: Number,
            default: 10
        },
        searching: {
            Type: Boolean,
            default: true
        },
        stateSave: {
            Type: Boolean,
            default: true
        },
        scrollX: {
            Type: Boolean,
            default: false
        },
        scrollY: {
            Type: Boolean,
            default: true
        },
        colReorder: {
            Type: Boolean,
            default: true
        },
        fixedHeader: {
            Type: Boolean,
            default: true
        }
    },
    data(){
        return {
            data: this.table,
        }
    },
    mounted() {
        this.getData()
        var table = $("#" + this.tableId).DataTable({
            autoWidth: true,
            data: this.table,
            processing: true,
            serverSide: false,
            ajax: this.apiUrl,
            pageLength: this.perPage,
            columns: this.columns,
            scrollY: '60vh',
            scrollX: this.scrollX,
            scrollCollapse: true,
            searching: this.searching,
            stateSave: this.stateSave,
            buttons: [
                {
                    extend: 'collection',
                    text: 'Funkcje',
                    className: 'action-buttons mb-2',
                    buttons: [
                        {
                            extend: 'copy',
                            text: 'Skopiuj',
                            className: 'btn btn-primary fs-10'
                        },
                        {
                            extend: 'csv',
                            text: 'Importuj do CSV',
                            className: 'btn btn-primary fs-10'
                        },
                        {
                            extend: 'pdf',
                            text: 'Pobierz jako PDF',
                            className: 'btn btn-primary fs-10'
                        },
                        {
                            extend: 'print',
                            text: 'Drukuj',
                            className: 'btn btn-primary fs-10'
                        },
                    ]
                },
                {
                    extend: 'colvis',
                    text: 'Kolumny',
                    className: 'btn btn-warning fs-10',
                    columns: 'th:nth-child(n+2)'
                },
                {
                    text: 'Usuń zaznaczone',
                    className: 'btn btn-danger fs-10',
                    action: function ( e, dt, node, config ) {
                        //this.deleteRow()
                        dt.row('.selected').remove().draw(false)
                    }
                },
                {
                    text: 'Zaznacz wszystko',
                    className: 'btn btn-success fs-10',
                    extend: 'selectAll'
                },
                {
                    text: 'Odznacz wszystko',
                    className: 'btn btn-success fs-10',
                    extend: 'selectNone'
                },

            ],
            lengthMenu: [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "Wszystkie"] ],
            // B - buttons | l -length changing | f - filtering inputs | r - processing | t - table | i - table information
            // p - pagination control | R - col reorder | P - search panes
            dom: '<"mt-2"B><"dt-toolbar d-flex justify-content-between mt-3"lf>r<t><"d-flex justify-content-between mt-3"ip>',
            colReorder: this.colReorder,
            fixedHeader: this.fixedHeader,
            select: true
        })
        table
            .on( 'select', function ( e, dt, type, indexes ) {
                indexes.forEach( function (index) {
                    let i = index + 1
                    document.querySelector('[data-id="' + i + '"]').checked = true
                })

            })
            .on( 'deselect', function ( e, dt, type, indexes ) {
                indexes.forEach( function (index) {
                    let i = index + 1
                    document.querySelector('[data-id="' + i + '"]').checked = false
                })

            })
    },
    watch: {

    },
    methods: {
        getData() {
            if (this.apiUrl !== null) {
                this.$http.get(this.apiUrl).then((response) => {
                    this.data = response.data
                })
            }
        },
        checkAll() {
            console.log('test')
        }
    }
}
</script>
