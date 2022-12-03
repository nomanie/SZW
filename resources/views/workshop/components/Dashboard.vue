<template>
    <div class="dashboard pt-5 pb-2 ms-4 me-4">
        <div class="row justify-content-center">
            <card :color="`blue`" :type="`chart`" :chart_data="d1"></card>
            <card :color="`red`" :type="`chart`" :chart_data="d2"></card>
            <card :color="`green`" :type="`chart`" :chart_data="d3"></card>
        </div>
        <div class="row mt-5">
            <card :color="`green`" :type="`information`" :information_data="i1"></card>
            <card :color="`orange`" :type="`information`" :information_data="i2"></card>
            <card :color="`red`" :type="`information`" :information_data="i3"></card>
            <card :color="`blue`" :type="`information`" :information_data="i4"></card>
        </div>
        <div class="row mt-5">
            <card :color="`orange`" :type="`list`" :table_data="t1"></card>
            <card :color="`green`" :type="`task_list`" :task_list_data="tl1"></card>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Dashboard',
    data() {
        return {
            d1: {
                percent: 55,
                last_updated: '5 minut temu',
                text_header: 'Ilość zleceń',
                chart_type: 'line',
            },
            d2: {
                percent: 0,
                last_updated: '2 godziny temu',
                text_header: 'Ilość klientów',
                chart_type: 'column',
            },
            d3: {
                percent: -23,
                last_updated: '1 dzień temu',
                text_header: 'Naprawionych pojazdów',
                chart_type: 'line',
            },
            i1: {
                header_icon: 'fa-solid fa-money-bill',
                header_text: 'Zarobek',
                value: '2452.50 pln',
                footer_content: 'Przedwczoraj',
                footer_icon: 'fa-regular fa-calendar'
            },
            i2: {
                header_icon: 'fa-regular fa-calendar',
                header_text: 'Zaplanowanych spotkań',
                value: '7',
                footer_content: 'najbliższe 23.08.2022 13:20',
                footer_icon: 'fa-regular fa-calendar'
            },
            i3: {
                header_icon: 'fa-solid fa-wrench',
                header_text: 'Zwrotów gwarancyjncyh',
                value: '2',
                footer_content: 'ostatnie zgłoszenie 2 dni temu',
                footer_icon: 'fa-regular fa-calendar'
            },
            i4: {
                header_icon: 'fa-regular fa-calendar',
                header_text: 'Wolnych terminów',
                value: '5',
                footer_content: 'ostatnio zapisany 6 godzin temu',
                footer_icon: 'fa-regular fa-calendar'
            },
            t1: {
                header_text: 'Lista klientów',
                header_span: 'Ostatni dodany 12 godzin temu',
                add_text: 'Dodaj klienta',
                columns: ['ID', 'Imię i Nazwisko', 'Numer telefonu', 'Ilość pojazdów', 'Miasto'],
                data: [
                    [1, 'Piotr Skwarek', '123 123 123', 2, 'Jastrzębie-Zdrój'],
                    [2, 'Adam Kowalski', '235 473 543', 1, 'Katowice'],
                    [3, 'Jan Wiśniewski', '958 743 235', 4, 'Wrocław'],
                    [4, 'Beata Nowak', '754 346 453', 1 , 'Warszawa'],
                    [5, 'Bogusław Pudel', '434 634 634', '3', 'Olsztyn']
                ]
            },
            tl1: {
                header_text: 'Lista Zadań',
                header_span: '22.08.2022',
                add_text: 'Dodaj zadanie',
                data: [
                    {
                        finished: false,
                        text: 'Wymiana klocków hamulcowych w Opel Astra G 1998r'
                    },
                    {
                        finished: false,
                        text: 'Wymiana opon w Citroen C3'
                    },
                    {
                        finished: false,
                        text: 'Naprawa zderzaka w Dacia Duster'
                    },
                    {
                        finished: true,
                        text: 'Czyszczenie tapicerki Seat Ibiza'
                    }
                ]
            }
        }
    }
}
</script>
