<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Faktura</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{mix('css/main.css')}}">
</head>
<body class="w-100">
<div class="container w-100">
    <div class="row">
        <div class="col">
            test1
        </div>
        <div class="col">
            test2
        </div>
    </div>
    <div class="document" ref="documentModal">
        <div class="row px-4">
            <div class="col-lg-6 col-12">
            </div>
            <div class="col-lg-6 col-12 d-flex justify-content-end flex-column">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <textarea class="textarea-viewing" rows="3">{{$data['fv_header']}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-end">
                        <div class="row justify-content-end">
                            <div class="header-date">
                                Data wystawienia:
                            </div>
                            <div class="col-6 col-lg-5">
                                <div>{{$data['issue_date']}}</div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="header-date">
                                Data sprzedaży:
                            </div>
                            <div class="col-6 col-lg-5">
                                {{$data['sold_date']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row cmt-4 px-4">
            <div class="col-12 fv-number">
                Faktura nr  {{$data['fv_number']}}
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
                                {{$data['issuer_name']}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <textarea class="textarea-viewing h-100">{{ $data['issuer_address'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                {{$data['issuer_nip']}}
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
                                        {{$data['recipient_name']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <textarea class="textarea-viewing h-100">{{ $data['recipient_address'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        {{$data['recipient_nip']}}
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
                    @foreach($data['document_contents'] as $index => $content)
                        <tr>
                            <td>
                                {{$index}}
                            </td>
                            <td>
                                <div> {{ $content['name'] }} </div>
                            </td>
                            <td>
                                <div> {{ $content['units'] }} </div>
                            </td>
                            <td>
                                <div> {{ $content['unit_net'] }} </div>
                            </td>
                            <td>
                                <div>
                                    {{ $content['vat_rate_id'] }}
                                </div>
                            </td>
                            <td>
                                <div> {{ $content['sum_net']}}</div>
                            </td>
                            <td>
                                <div> {{ $content['sum_vat']}}</div>
                            </td>
                            <td>
                                <div> {{ $content['sum_gross']}}</div>
                            </td>

                        </tr>
                    @endforeach
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td class="sum-td">
                            Suma
                        </td>
                        <td class="sum-td">
                            <div> {{ $data['sum_net'] }} </div>
                        </td>
                        <td class="sum-td">
                            <div> {{ $data['sum_vat'] }} </div>
                        </td>
                        <td class="sum-td">
                            <div> {{ $data['sum_gross'] }} </div>
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
                            <div>
                                {{ $data['payment_type'] }}
                            </div>
                        </td>
                        <td>
                            Razem:
                        </td>
                        <td>
                            {{ $data['sum_gross'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Termin zapłaty:
                        </td>
                        <td>
                            {{ $data['payment_date'] }}
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
                            <div>
                                {{ $data['bank_type'] }}
                            </div>
                        </td>
                        <td>
                            Do zapłaty:
                        </td>
                        <td>
                            {{ $data['sum_gross'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nr konta:
                        </td>
                        <td>
                            <div>
                                {{ $data['account_number'] }}
                            </div>
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
                            <div>
                                {{ $data['comments'] }}
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
</div>
</body>
<style>
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

    @media (max-width: 991px) {
        .table-container {
            overflow: auto;
        }
    }
    .row {
        display: flex;
        margin-right: -15px;
        margin-left: -15px;
    }
    .justify-content-end {
        justify-content: flex-end !important;
    }
    .col-lg-5 {
        max-width: 41.66666667%;
    }
    .col-12 {
        max-width: 100%;
    }
    .d-flex {
        display: flex !important;
    }
    .pl-4, .px-4 {
        padding-left: 1.5rem !important;
    }
    .mb-4, .my-4 {
        margin-bottom: 1.5rem !important;
    }
</style>
</html>
