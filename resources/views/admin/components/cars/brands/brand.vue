<template>
    <div class="container mt-3">
        <div v-if="!is_edit">
            <div class="d-flex justify-content-end">
                <modal></modal>
            </div>
            <vuetable ref="vuetable"
                      v-if="table"
                      :api-mode="false"
                      :fields="fields"
                      :data="table.data"
                      :css="style.table"
            >
                <div slot="checkboxes" slot-scope="props">
                    <b-form-checkbox v-model="selected" :value="props.rowData.id"></b-form-checkbox>
                </div>
                <div slot="actions" slot-scope="props">
                    <button @click="remove(props.rowData.id)" class="btn btn-danger" v-b-tooltip.hover title="Usuń">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button class="btn btn-success" v-b-tooltip.hover title="Edytuj" @click="edit(props.rowData.id)">
                        <i class="fa fa-pencil"></i>
                    </button>
                </div>
            </vuetable>
            <div class="vuetable-custom-pagination" v-if="table">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mx-1" @click="prevPage">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <button class="btn btn-primary" v-if="table.current_page - 2 > table.from" @click="setPage(table.from)">...</button>
                    <button
                        class="btn mx-1"
                        v-for="i in table.last_page"
                        :class="[table.current_page !== i ? 'btn-primary' : 'btn-success']"
                        v-if="table.current_page + 3 >= i && table.current_page - 2 <= i"
                        @click="setPage(i)"
                    >
                        {{ i }}
                    </button>
                    <div v-else ></div>
                    <button class="btn btn-primary" v-if="table.current_page + 3 <= table.last_page" @click="setPage(table.last_page)">...</button>
                    <button class="btn btn-primary mx-1">
                        <i class="fa fa-arrow-right" @click="nextPage"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import vuetableStyle from "../../../../../js/config/styles/vuetable";
import modal from './modal'

export default {
    components: {
        Vuetable,
        modal,
    },
    data() {
        return {
            selected: [],
            is_edit: false,
            id: null,
            table: null,
            style: vuetableStyle,
            fields: [
                {
                    name: 'checkboxes',
                    title: ''
                },
                {
                    name: 'id',
                    sortField: 'id',
                    title: 'ID'
                },
                {
                    name: 'name',
                    sortField: 'name',
                    title: 'Marka'
                },
                {
                    name: 'actions',
                    title: 'Akcje'
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
                console.log(this.table)
            }).catch((error) => {

            })
        },
        remove(id) {
            this.$http.delete(route('admin.cars.brand.destroy', id)).then((response) => {
                this.getData()
            }).catch((error) => {
            })
        },
        edit(id) {
            this.id = id
            this.is_edit = true
        },
        //zrobić mixina do vueTable
        setPage(page = 1)
        {
            this.table.current_page = page
        },
        nextPage() {
            if(this.table.current_page < this.table.last_page) {
                this.table.current_page++
            }
        },
        prevPage() {
            if(this.table.current_page > this.table.from) {
                this.table.current_page--
            }
        }
    }
}
</script>
