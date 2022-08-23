<template>
    <div class="mt-5">
        <card :color="`green`" :type="`list`" :table_data="items" :full_width="true"></card>
    </div>
</template>

<script>
export default {
    name: 'Clients',
    data() {
        return {
            items: {
                header_text: 'Lista klientów',
                header_span: 'Ostatni dodany 12 godzin temu',
                add_text: 'Dodaj klienta',
                columns: ['ID', 'Imię i Nazwisko', 'Numer telefonu', 'Ilość pojazdów', 'Miasto', 'Akcja'],
                data: [
                    [1, 'Piotr Skwarek', '123 123 123', 2, 'Jastrzębie-Zdrój' , 'Dodaj | Usuń'],
                    [2, 'Adam Kowalski', '235 473 543', 1, 'Katowice' , 'Dodaj | Usuń'],
                    [3, 'Jan Wiśniewski', '958 743 235', 4, 'Wrocław' , 'Dodaj | Usuń'],
                    [4, 'Beata Nowak', '754 346 453', 1 , 'Warszawa' , 'Dodaj | Usuń'],
                    [5, 'Bogusław Pudel', '434 634 634', '3', 'Olsztyn' , 'Dodaj | Usuń']
                ]
            }
        }
    }
}
</script>
