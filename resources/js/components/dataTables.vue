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
import "datatables.net-datetime";
import "datatables.net-searchbuilder-dt";
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
        },
        tableName: {
            type: String,
            default: 'Tabela'
        },
        deleteUrl: {
            type: String,
            default: null
        },
        reloadTable: {
            Type: Number,
            default: null
        }
    },
    data(){
        return {
            data: this.table,
            datatable: null
        }
    },
    mounted() {
        this.getData()
        var _self = this
        this.datatable = $("#" + this.tableId).DataTable({
            autoWidth: true,
            language: {
                url: 'http://127.0.0.1:8000/lang/pl/datatables.json'
            },
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
                    text: 'Export',
                    className: 'action-buttons mb-2',
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fa-regular fa-copy"></i> Skopiuj',
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)'
                            },
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa-solid fa-table-cells-large"></i> CSV',
                            filename: _self.tableName,
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)'
                            },
                        },
                        {
                            extend:'pdfHtml5',
                            text:'<i class="fa-solid fa-file-pdf"></i> PDF',
                            filename: _self.tableName,
                            orientation:'landscape',
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)'
                            },
                            customize : function(doc){
                                var colCount = new Array();

                                document.querySelector("#" + _self.tableId).querySelectorAll('thead tr:first-child th').forEach(function(item){
                                    if(!item.classList.contains("not-exportable")) {
                                       if(item.getAttribute('colspan')){
                                           for(var i = 1;i <= item.getAttribute('colspan'); i++){
                                               colCount.push('*');
                                           }
                                       }else{
                                           colCount.push('*');
                                       }
                                   }
                                });
                                doc.content[1].table.widths = colCount;
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa-solid fa-print"></i> Drukuj',
                            filename: _self.tableName,
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)'
                            },
                        },
                    ]
                },
                {
                    extend: 'collection',
                    text: 'Zaznaczone',
                    className: 'action-buttons mb-2',
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fa-regular fa-copy"></i> Skopiuj',
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)',
                                modifier: {
                                    selected: true
                                }
                            },
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa-solid fa-table-cells-large"></i> CSV',
                            filename: _self.tableName,
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)',
                                modifier: {
                                    selected: true
                                }
                            },
                        },
                        {
                            extend:'pdfHtml5',
                            text:'<i class="fa-solid fa-file-pdf"></i> PDF',
                            filename: _self.tableName,
                            orientation:'landscape',
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)',
                                modifier: {
                                    selected: true
                                }
                            },
                            customize : function(doc){
                                var colCount = new Array();
                                document.querySelector("#" + _self.tableId).querySelectorAll('thead tr:first-child th').forEach(function(item){
                                    if(!item.classList.contains("not-exportable")) {
                                        if(item.getAttribute('colspan')){
                                            for(var i = 1;i <= item.getAttribute('colspan'); i++){
                                                colCount.push('*');
                                            }
                                        }else{
                                            colCount.push('*');
                                        }
                                    }
                                });
                                doc.content[1].table.widths = colCount;
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa-solid fa-print"></i> Drukuj',
                            filename: _self.tableName,
                            exportOptions: {
                                columns: ':visible :not(.not-exportable)',
                                modifier: {
                                    selected: true
                                }
                            },
                        },
                    ]
                },
                {
                    extend: 'colvis',
                    text: 'Kolumny',
                    className: 'btn btn-warning fs-10 ms-1',
                },
                {
                    text: 'Usuń zaznaczone',
                    className: 'btn btn-danger fs-10',
                    action: function ( e, dt, node, config ) {
                        _self.removeSelected(dt.cells('.selected', 0).data().toArray())
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
            select: true,
        })
    },
    watch: {
        reloadTable: function() {
            console.log('test')
            this.datatable.ajax.reload()
        }
    },
    methods: {
        getData() {
            if (this.apiUrl !== null) {
                this.$http.get(this.apiUrl).then((response) => {
                    this.data = response.data
                })
            }
        },
        removeSelected(ids) {
            if (this.deleteUrl) {
                this.$http.post(route(this.deleteUrl, 0), {_method: 'delete', data: ids}).then((response) => {
                    this.datatable.ajax.reload();
                })
            }
        }
    }
}
</script>
