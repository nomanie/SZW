<template>
    <div>
        <b-modal id="client-documents-modal" title="Dodaj nowy Dokument" size="lg" @shown="defaultForm">
            <div class="document">
                <div class="row px-4">
                    <div class="col-lg-6 col-12">
                        <img src="../../../../../../../public/images/g7622.png">
                    </div>
                    <div class="col-lg-6 col-12 d-flex justify-content-end flex-column">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <textarea placeholder="nagłówek dokumentu" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex flex-column justify-content-end">
                                <div class="row justify-content-end">
                                    <div class="header-date">
                                        Data wystawienia:
                                    </div>
                                    <div class="col-6 col-lg-5">
                                        <input type="date" class="w-100">
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="header-date">
                                        Data sprzedaży:
                                    </div>
                                    <div class="col-6 col-lg-5">
                                        <input type="date" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row cmt-4 px-4">
                    <div class="col-12 fv-number">
                        Faktura nr /1/2023/12
                    </div>
                </div>
                <hr class="separator">
                <div class="row px-4 mb-4">
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 font-weight-bold mb-3">
                                Sprzedawca
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" placeholder="nazwa sprzedawcy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <textarea placeholder="adres sprzedawcy" class="h-100"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" placeholder="NIP sprzedawcy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 font-weight-bold mb-3">
                                Nabywca
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" placeholder="nazwa nabywcy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea placeholder="adres nabywcy" class="h-100"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" placeholder="NIP/Pesel nabywcy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 table-container">
                    <div style="width: 747px; margin:auto;">
                        <table class="content-table text-center">
                            <tr>
                                <th style="width: 50px">
                                    Lp
                                </th>
                                <th style="width: 250px">
                                    Nazwa towaru lub usługi
                                </th>
                                <th style="width: 50px">
                                    Ilość
                                </th>
                                <th style="width: 60px">
                                    Cena Netto
                                </th>
                                <th style="width: 60px">
                                    Stawka VAT
                                </th>
                                <th style="width: 60px">
                                    Wartość Netto
                                </th>
                                <th style="width: 60px">
                                    Wartość VAT
                                </th>
                                <th style="width: 60px">
                                    Wartość Brutto
                                </th>
                            </tr>
                            <tr v-for="(content, index) in form.contents">
                                <td>
                                    {{ index }}
                                </td>
                                <td>
                                    <input type="text" v-model="form.contents[index].name" class="w-100">
                                </td>
                                <td>
                                    <input type="text" v-model="form.contents[index].units" class="w-100">
                                </td>
                                <td>
                                    <input type="text" v-model="form.contents[index].unit_cost" class="w-100">
                                </td>
                                <td>
                                    <v-select
                                        v-model="form.contents[index].vat_rate_id"
                                        :options="vat_rate_options"
                                        class="w-100"
                                        :clearable="false"
                                    >
                                        <!-- @todo searchable psuje v-selecta-->
                                        <template #open-indicator="{ attributes }">
                                            <span v-bind="attributes"></span>
                                        </template>
                                    </v-select>
                                </td>
                                <td>
                                    <input type="text" v-model="form.contents[index].sum_net" class="w-100" disabled>
                                </td>
                                <td>
                                    <input type="text" v-model="form.contents[index].sum_vat" class="w-100" disabled>
                                </td>
                                <td>
                                    <input type="text" v-model="form.contents[index].sum_gross" class="w-100" disabled>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <template #modal-footer="{cancel}">
                <div class="w-100 justify-content-between d-flex">
                    <button type="button" class="btn btn-warning me-4" @click="defaultForm"><i
                        class="fa fa-eraser pe-3"></i>
                        Wyczyść
                    </button>
                    <div>
                        <button type="button" class="btn btn-success" @click="btnUrl"><i class="fa fa-save pe-3"></i>
                            Zapisz
                        </button>
                        <button type="button" class="btn btn-danger" @click="cancel()">
                            <i class="fa-solid fa-xmark pe-3"></i>
                            Anuluj
                        </button>
                    </div>
                </div>
            </template>
        </b-modal>
    </div>
</template>
<script>
import error from '@js/assets/form/error'
import FormatField from '@js/components/FormatField'

export default {
    components: {
        error,
        FormatField
    },
    props: {
        data: {
            type: [Object, Array],
            default: () => {
            }
        },
        show: {
            type: Boolean,
            default: () => {
            }
        }
    },
    data() {
        return {
            modalShow: true,
            form: this.data,
            is_edit: false,
            errors: {},
            vat_rate_options: [
                {
                    label: '23%',
                    value: 0.23
                },
                {
                    label: '8%',
                    value: 0.08
                },
                {
                    label: '5%',
                    value: 0.05
                },
                {
                    label: '0%',
                    value: 0.00
                }
            ]
        }
    },
    watch: {
        data: function () {
            this.form = this.data
            this.is_edit = true
        },
    },
    computed: {
        btnUrl() {
            return this.is_edit ? this.edit : this.save
        }
    },
    methods: {
        defaultForm() {
            if (!this.is_edit) {
                this.form = {
                    first_name: null,
                    last_name: null,
                    phone: null,
                    info: null,
                    email: null,
                    zip_code: null,
                    building_number: null,
                    flat_number: null,
                    city: null,
                    street: null,
                    date_of_birth: null,
                    contents: [
                        {
                            name: null,
                            units: null,
                            unit_cost: null,
                            vat_rate_id: null,
                            sum_net: null,
                            sum_vat: null,
                            sum_gross: null,
                        }
                    ]
                }
            }
        },
        save() {
            this.$http.post(route('workshop.clients.store'), this.form).then((response) => {
                this.$bvModal.hide('clients-modal')
                this.$emit('reload')
            })
        },
        edit() {
            this.$http.put(route('workshop.clients.update', this.form.id), this.form).then((response) => {
                this.$bvModal.hide('clients-modal')
                this.$emit('reload')
            })
        }
    }
}
</script>
<style type="scss" scoped>
.cmt-4 {
    margin-top: 2.5rem;
}

.fv-number {
    padding: 5px 15px;
    background: #e7903e;
    color: white;
    font-size: 18px;
}

.header-date {
    width: 120px;
    display: flex;
}

.separator {
    border-width: 3px;
    border-color: #777676;
}

.content-table {

}

th {
    background: #e7903e;
    text-align: center;
    border: solid 1px;
    padding: 0 10px;
    color: white;
}

@media (max-width: 991px) {
    .table-container {
        overflow: auto;
    }
}
</style>
