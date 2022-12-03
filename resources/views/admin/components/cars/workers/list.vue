<template>
    <div class="container mt-3">
        <div v-if="!is_edit">
            <div class="d-flex justify-content-end">
                <modal @save="getData"></modal>
            </div>
            <vuetable ref="vuetable"
                      :api-mode="false"
                      :fields="fields"
                      :data="table"
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
                    <button class="btn btn-warning" v-b-tooltip.hover title="Archiwizuj">
                        <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </vuetable>
        </div>
        <div v-else>
            <div class="breadcrumbs">
                <span @click="is_edit = false">Lista pracowników</span>
                <i class="fa fa-chevron-left"></i>
                <span class="active">Edycja pracownika</span>
            </div>
            <edit :id="id" @close="is_edit = false"></edit>
        </div>
    </div>
</template>
<script>
import Vuetable from 'vuetable-2'
import vuetableStyle from "../../../../config/styles/vuetable";
import modal from './modal'
import TaskList from "../../../../assets/task_list/TaskList";
import edit from './edit'

export default {
    components: {
        TaskList,
        modal,
        Vuetable,
        edit
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
                    name: 'first_name',
                    sortField: 'first_name',
                    title: 'Imię'
                },
                {
                    name: 'last_name',
                    sortField: 'last_name',
                    title: 'Nazwisko'
                },
                {
                    name: 'email',
                    sortField: 'email',
                    title: 'E-mail'
                },
                {
                    name: 'position',
                    sortField: 'position',
                    title: 'Stanowisko'
                },
                {
                    name: 'actions'
                }
            ]
        }
    },
    computed: {
        apiUrl() {
            return route('api.workers.index');
        }
    },
    mounted() {
      this.getData()
    },
    methods: {
        getData() {
            this.$http.get(this.apiUrl).then((response) => {
                this.table = response.data
            }).catch((error) => {
                this.$bvToast.toast('Nie udało się pobrać rekordów', {
                    title: 'Błąd',
                    autoHideDelay: 5000,
                    variant: 'danger',
                })
            })
        },
        remove(id) {
            this.$http.delete(route('api.workers.destroy', id)).then((response) => {
                this.getData()
                this.$bvToast.toast(response.data.message, {
                    title: 'Komunikat',
                    autoHideDelay: 5000,
                    variant: 'success',
                })
            }).catch((error) => {
                this.$bvToast.toast(error.data.message, {
                    title: 'Błąd',
                    autoHideDelay: 5000,
                    variant: 'danger',
                })
            })
        },
        edit(id) {
            this.id = id
            this.is_edit = true
        }
    }
}
</script>
