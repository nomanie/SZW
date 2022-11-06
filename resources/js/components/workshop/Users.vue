<template>
    <div class="users mt-5">
        <div class="row">
            <card :color="`dark-green`" :type="`list`" :table_data="t1"></card>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Users',
    data() {
        return {
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
        }
    }
}
</script>
