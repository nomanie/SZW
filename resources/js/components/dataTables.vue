<template>
    <table class="table table-bordered yajra-datatable" :id="tableId">
        <thead>
        <tr>
            <th v-for="column in cols">
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

import dtMixin from '../mixins/dtMixin';
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
            default: true
        },
        scrollY: {
            Type: Boolean,
            default: false
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
            type: Number,
            default: null
        },
        modalId: {
            type: String,
            default: 'false'
        },
        reloadDT: {
            type: Number,
            default: 0
        }
    },
    mixins: [dtMixin],
    data(){
        return {
            datatable: null,
            cols: this.columns,
            options: [],
            data: null
        }
    },
    mounted() {
        this.render()
    },
    watch: {
        reloadTable: function() {
            this.datatable.ajax.reload()
        },
    },
    methods: {
        removeSelected(ids) {
            if (this.deleteUrl) {
                this.$http.post(route(this.deleteUrl, 0), {_method: 'delete', data: ids}).then((response) => {
                    this.datatable.ajax.reload();
                })
            }
        },
        render() {
            var _self = this
            this.datatable = $("#" + this.tableId).DataTable({
                autoWidth: true,
                language: {
                    url: 'http://127.0.0.1:8000/lang/pl/datatables.json'
                },
                processing: true,
                serverSide: true,
                ajax: route(this.apiUrl + '.index'),
                pageLength: this.perPage,
                columns: this.cols,
                scrollY: '50vh',
                scrollX: this.scrollX,
                scrollCollapse: true,
                searching: this.searching,
                stateSave: this.stateSave,
                buttons: [
                    {
                        extend: 'collection',
                        text: 'Export',
                        className: 'action-buttons mb-2 fs-10',
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
                        className: 'action-buttons mb-2 fs-10',
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
                                text:'<i class="fa-solid fa-file-pdf"></i> PDF',
                                filename: _self.tableName,
                                orientation:'landscape',
                                exportOptions: {
                                    columns: ':visible :not(.not-exportable)',
                                    modifier: {
                                        selected: true
                                    }
                                },
                                action: function ( e, dt, node, config ) {
                                    let columns = _self.columns.filter(column => column.exportable !== false)
                                    let rows = (dt.rows( { selected: true } ).data())
                                    let ids = rows.map(row => row.id).toArray()
                                    let data = {
                                        type: 'pdf',
                                        columns: columns.map(column => column.data),
                                        ids: ids
                                    }
                                    _self.$http.post(route(_self.apiUrl + '.export'), data).then((response) => {
                                        console.log(response)
                                        window.location = route(_self.apiUrl + '.download', response.data.id)
                                    })
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
                        className: 'btn fs-10 ms-1 mb-2',
                        columnText: function(dt, idx, title){
                            return title !== '' ? title : 'Akcje'
                        }
                    },
                    {
                        text: 'Usuń zaznaczone',
                        className: 'btn btn-danger fs-10 mb-2',
                        action: function ( e, dt, node, config ) {
                            _self.removeSelected(dt.cells('.selected', 0).data().toArray())
                        }
                    },
                    {
                        text: 'Zaznacz wszystko',
                        className: 'btn btn-success fs-10 mb-2',
                        extend: 'selectAll'
                    },
                    {
                        text: 'Odznacz wszystko',
                        className: 'btn btn-success fs-10 mb-2',
                        extend: 'selectNone'
                    },
                    {
                        text: 'Dodaj rekord',
                        className: 'btn btn-primary fs-10 mb-2',
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary')
                        },
                        action: function ( e, dt, node, config ){
                           _self.$emit('add')
                        }
                    },

                ],
                lengthMenu: [ [10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "Wszystkie"] ],
                // B - buttons | l -length changing | f - filtering inputs | r - processing | t - table | i - table information
                // p - pagination control | R - col reorder | P - search panes
                dom: '<"mt-2"B><"dt-toolbar d-flex justify-content-between mt-3"lf>r<t><"d-flex justify-content-between mt-3"ip>',
                colReorder: this.colReorder,
                fixedHeader: this.fixedHeader,
                select: {
                    style: 'multi',
                    selector: ':not(.not-selectable, .not-selectable *)'
                },
            })
        }
    }
}
</script>
