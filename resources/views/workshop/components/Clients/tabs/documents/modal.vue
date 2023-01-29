<template>
    <div>
        <b-modal id="client-documents-modal" title="Dodaj nowy Dokument" size="lg" @shown="defaultForm">
            <div class="document" ref="documentModal">
                <div class="row px-4">
                    <div class="col-lg-6 col-12">
                        <img src="../../../../../../../public/images/g7622.png">
                    </div>
                    <div class="col-lg-6 col-12 d-flex justify-content-end flex-column">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <textarea :class="[!viewing ? '' : 'textarea-viewing']" :disabled="viewing" placeholder="nagłówek dokumentu" rows="3" v-model="form.fv_header"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex flex-column justify-content-end">
                                <div class="row justify-content-end">
                                    <div class="header-date">
                                        Data wystawienia:
                                    </div>
                                    <div class="col-6 col-lg-5">
                                        <input v-if="!viewing" type="date" class="w-100" v-model="form.issue_date">
                                        <div v-else> {{ form.issue_date }}</div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="header-date">
                                        Data sprzedaży:
                                    </div>
                                    <div class="col-6 col-lg-5">
                                        <input v-if="!viewing" type="date" class="w-100" v-model="form.sold_date">
                                        <div v-else> {{ form.sold_date }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row cmt-4 px-4">
                    <div class="col-12 fv-number">
                        Faktura nr {{form.fv_number}}
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
                                        <input v-if="!viewing" type="text" placeholder="nazwa sprzedawcy" v-model="form.issuer_name">
                                        <div v-else> {{ form.issuer_name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <textarea :class="[!viewing ? '' : 'textarea-viewing']" :disabled="viewing" placeholder="adres sprzedawcy" class="h-100" v-model="form.issuer_address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <input v-if="!viewing" type="text" placeholder="NIP sprzedawcy" v-model="form.issuer_nip">
                                        <div v-else> {{ form.issuer_nip }}</div>
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
                                                <input v-if="!viewing" type="text" placeholder="nazwa nabywcy" v-model="form.recipient_name">
                                                <div v-else>{{ form.recipient_name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea :class="[!viewing ? '' : 'textarea-viewing']" :disabled="viewing" placeholder="adres nabywcy" class="h-100" v-model="form.recipient_address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <input v-if="!viewing" type="text" placeholder="NIP/Pesel nabywcy" v-model="form.recipient_nip">
                                                <div v-else>{{ form.recipient_nip }}</div>
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
                                <th style="width: 200px">
                                    Nazwa towaru lub usługi
                                </th>
                                <th style="width: 50px">
                                    Ilość
                                </th>
                                <th style="width: 60px">
                                    Cena Netto
                                </th>
                                <th style="width: 85px">
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
                                    <input v-if="!viewing" type="text" v-model="form.contents[index].name" class="w-100 form-control text-left">
                                    <div v-else> {{ form.contents[index].name }} </div>
                                </td>
                                <td>
                                    <input v-if="!viewing" type="text" v-model="form.contents[index].units" class="w-100 form-control" @input="calculate(index)">
                                    <div v-else> {{ form.contents[index].units }} </div>
                                </td>
                                <td>
                                    <input v-if="!viewing" type="text" v-model="form.contents[index].unit_net" class="w-100 form-control" @input="calculate(index)">
                                    <div v-else> {{ form.contents[index].unit_net }} </div>
                                </td>
                                <td>
                                    <vselect
                                        v-if="!viewing"
                                        v-model="form.contents[index].vat_rate_id"
                                        placeholder="Stawka VAT"
                                        :options="vat_rate_options"
                                        :clearable="false"
                                        :searchable="false"
                                        :close-on-select="true"
                                        :hide-on-backdrop="true"
                                        @option:selected="setVatRate(index, $event)"
                                    >
                                    </vselect>
                                    <div v-else >
                                        {{ form.contents[index].vat_rate_id.label }}
                                    </div>
                                </td>
                                <td>
                                    <input v-if="!viewing" type="text" v-model="form.contents[index].sum_net" class="w-100 form-control" disabled>
                                    <div v-else> {{ form.contents[index].sum_net}}</div>
                                </td>
                                <td>
                                    <input v-if="!viewing" type="text" v-model="form.contents[index].sum_vat" class="w-100 form-control" disabled>
                                    <div v-else> {{ form.contents[index].sum_vat}}</div>
                                </td>
                                <td>
                                    <input v-if="!viewing" type="text" v-model="form.contents[index].sum_gross" class="w-100 form-control" disabled>
                                    <div v-else> {{ form.contents[index].sum_gross}}</div>
                                </td>
                                <td v-if="index > 0 && !viewing" style="width:30px">
                                    <i class="fa-solid fa-trash cursor-pointer fs-16 text-danger" v-b-tooltip title="Usuń pozycję" @click="removePosition(index)"></i>
                                </td>
                                <td style="width:30px;" v-if="index === form.contents.length - 1 && !viewing">
                                    <i class="fa-solid fa-plus cursor-pointer fs-16" v-b-tooltip title="Dodaj kolejną pozycję" @click="addPosition()"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td :class="[!viewing ? '' : 'sum-td']">
                                    Suma
                                </td>
                                <td :class="[!viewing ? '' : 'sum-td']">
                                    <input v-if="!viewing" type="text" v-model="form.sum_net" class="w-100 form-control" disabled>
                                    <div v-else> {{ form.sum_net }} </div>
                                </td>
                                <td :class="[!viewing ? '' : 'sum-td']">
                                    <input v-if="!viewing" type="text" v-model="form.sum_vat" class="w-100 form-control" disabled>
                                    <div v-else> {{ form.sum_vat }} </div>
                                </td>
                                <td :class="[!viewing ? '' : 'sum-td']">
                                    <input v-if="!viewing" type="text" v-model="form.sum_gross" class="w-100 form-control" disabled>
                                    <div v-else> {{ form.sum_gross }} </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-4 mb-5" style="width: 747px; margin:auto;">
                        <table style="width: 687px;" class="summary_table">
                            <tr>
                                <td>
                                    Forma płatności:
                                </td>
                                <td>
                                    <vselect
                                        v-if="!viewing"
                                        v-model="form.payment_type"
                                        :options="paymentTypes"
                                        :clearable="false"
                                        :searchable="false"
                                        :close-on-select="true"
                                        :hide-on-backdrop="true"
                                        @option:selected="setPaymentType($event)"
                                    >
                                    </vselect>
                                    <div v-else>
                                        {{ form.payment_type.label }}
                                    </div>
                                </td>
                                <td>
                                    Razem:
                                </td>
                                <td>
                                    {{form.sum_gross}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Termin zapłaty:
                                </td>
                                <td>
                                    <input v-if="!viewing" type="date" v-model="form.payment_date">
                                    <div v-else>{{ form.payment_date }}</div>
                                </td>
                                <td>
                                    Płatność otrzymana:
                                </td>
                                <td>
                                    0.00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Bank:
                                </td>
                                <td>
                                    <input v-if="!viewing" type="text" v-model="form.bank_type">
                                    <div v-else>{{ form.bank_type }}</div>
                                </td>
                                <td>
                                    Do zapłaty:
                                </td>
                                <td>
                                    {{form.sum_gross}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nr konta:
                                </td>
                                <td>
                                    <format-field
                                        v-if="!viewing"
                                        :key='form.account_number'
                                        :data='form.account_number'
                                        :min="0"
                                        :max="26"
                                        :state="errors.account_number && errors.account_number.length > 0"
                                        format="..-....-....-....-....-....-...."
                                        placeholder="Numer konta"
                                        @input="form.account_number = $event"
                                    ></format-field>
                                    <div v-else>{{ form.account_number }}</div>
                                </td>
                                <td>
                                    Słownie:
                                </td>
                                <td>
                                    zrobić funkcje
                                </td>
                            </tr>
                            <tr>
                                <td>Uwagi</td>
                                <td colspan="3">
                                    Zwolenienie z podatku VAT na podstawie:
                                    <vselect
                                        v-if="!viewing"
                                        v-model="form.notes"
                                        :options="noteTypes"
                                        :clearable="false"
                                        :searchable="false"
                                        :close-on-select="true"
                                        :hide-on-backdrop="true"
                                        @option:selected="setNote($event)"
                                    >
                                    </vselect>
                                    <div v-else>
                                        {{ form.notes.label }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-5">
                        <div class="row mt-5">
                            <div class="col-12 col-md-6 text-center">
                                . . . . . . . . . . . . . . . . . . . . . . . . <br>
                                <span class="fs-10">Podpis nabywcy</span>
                            </div>
                            <div class="col-12 col-md-6 text-center">
                                . . . . . . . . . . . . . . . . . . . . . . . . <br>
                                <span class="fs-10">Podpis wystawcy</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <template #modal-footer="{cancel}">
                <div class="w-100 justify-content-between d-flex">
                    <div>
                        <button type="button" class="btn btn-warning me-4" @click="defaultForm">
                            <i class="fa fa-eraser pe-3"></i>
                            Wyczyść
                        </button>
                        <button type="button" class="btn me-4" :class="[viewing ? 'btn-outline-secondary' : 'btn-secondary']" @click="view">
                            <i class="fa fa-eye pe-3"></i>
                            {{viewing ? 'Podgląd' : 'Edycja'}}
                        </button>
                    </div>
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
import {priceFormat} from "@js/app";

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
        },
        isEdit: {
            type: Boolean,
            default: () => false
        }
    },
    data() {
        return {
            modalShow: true,
            form: this.data,
            is_edit: false,
            viewing: false,
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
            ],
            paymentTypes: [
                {
                    label: 'Gotówką',
                    value: 0
                },
                {
                    label: 'Kartą',
                    value: 1
                },
                {
                    label: 'Internetowo',
                    value: 2
                }
            ],
            noteTypes: [
                {
                    label: 'art. 43 ust. 1 pkt 40 ustawy o podatku od towarów i usług.',
                    value: 0
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
                    fv_header: null,
                    issue_date: null,
                    sold_date: null,
                    issuer_name: null,
                    issuer_address: null,
                    issuer_nip: null,
                    recipient_name: null,
                    recipient_address: null,
                    recipient_nip: null,
                    sum_vat: null,
                    sum_net: null,
                    sum_gross: null,
                    payment_date: null,
                    bank_type: null,
                    account_number: null,
                    notes: {
                        label: 'Wybierz',
                        value: null
                    },
                    payment_type: {
                        label: 'Wybierz',
                        value: null
                    },
                    contents: [
                        {
                            name: null,
                            units: null,
                            unit_net: null,
                            vat_rate_id: {
                                label: 'Wybierz',
                                value: null
                            },
                            sum_net: null,
                            sum_vat: null,
                            sum_gross: null,
                        }
                    ],
                    fv_number: '1/2023/12'
                }
            }
        },
        save() {
            this.form.client_id = this.$route.params.id
            this.$http.post(route('workshop.documents.store'), this.form).then((response) => {
                this.$bvModal.hide('client-documents-modal')
                this.$emit('reload')
            })
        },
        edit() {
            this.$http.put(route('workshop.documents.update', this.form.id), this.form).then((response) => {
                this.$bvModal.hide('client-documents-modal')
                this.$emit('reload')
            })
        },
        setVatRate(index, $event) {
            this.form.contents[index].vat_rate_id = $event
            this.calculate(index)
        },
        setPaymentType($event) {
            this.form.payment_type = $event
        },
        calculate(index) {
            if (
                this.form.contents[index].vat_rate_id !== null
                && this.form.contents[index].vat_rate_id.value !== null
                && this.form.contents[index].units !== null
                && this.form.contents[index].unit_net !== null
            ) {
                this.calculateNet(index)
                this.$nextTick()
                this.calculateVat(index)
                this.$nextTick()
                this.calculateGross(index)
                this.$nextTick()
                this.calculateFinalSums()
            }
        },
        calculateNet(index) {
            this.form.contents[index].sum_net = priceFormat((this.form.contents[index].units * this.form.contents[index].unit_net))
        },
        calculateVat(index) {
            this.form.contents[index].sum_vat = priceFormat((this.form.contents[index].sum_net) * this.form.contents[index].vat_rate_id.value)
        },
        calculateGross(index) {
            this.form.contents[index].sum_gross = priceFormat(parseFloat((this.form.contents[index].sum_net)) + (parseFloat(this.form.contents[index].sum_net) * this.form.contents[index].vat_rate_id.value))
        },
        calculateFinalSums() {
            let sum_vat = 0
            let sum_net = 0
            let sum_gross = 0
            this.form.contents.forEach(function(element, index) {
                sum_vat += parseFloat(element.sum_vat)
                sum_net += parseFloat(element.sum_net)
                sum_gross += parseFloat(element.sum_gross)
            })
            this.form.sum_vat = priceFormat(sum_vat)
            this.form.sum_net = priceFormat(sum_net)
            this.form.sum_gross = priceFormat(sum_gross)
        },
        addPosition() {
            this.form.contents.push({
                name: null,
                units: null,
                unit_net: null,
                vat_rate_id: {
                    label: 'Wybierz',
                    value: null
                },
                sum_net: null,
                sum_vat: null,
                sum_gross: null,
            })
        },
        removePosition(index) {
            this.form.contents.splice(index, 1)
            this.calculateFinalSums()
        },
        setNote($event) {
            this.form.notes = $event
        },
        view() {
            this.viewing = !this.viewing
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
td > input, .vs__dropdown-toggle {
    padding: 4px 0;
    height: auto !important;
}
.summary_table td {
    /*border: solid 1px black;*/
}

.sum-td {
    background: #e7903e;
}

.textarea-viewing {
    border: none;
    resize: none;
    background: none;
}

@media (max-width: 991px) {
    .table-container {
        overflow: auto;
    }
}
</style>
