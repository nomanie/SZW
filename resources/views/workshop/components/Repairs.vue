<template>
    <div class="mt-5">
        <card :color="`red`" :type="`list`" :table_data="items" :full_width="true" :list_hover="true" :list_striped="true"></card>
    </div>
</template>

<script>
export default {
    name: 'Repairs',
    data() {
        return {
            items: {
                header_text: 'Lista Napraw',
                header_span: 'Ostatnio dodany 1 dzień temu',
                add_text: 'Dodaj Zlecenie',
                columns: ['ID', 'Typ', 'Przypisany do', 'Kwota', 'Zapłacone', 'Zarejestrowano', 'Akcja'],
                data: [
                    [1, 'Naprawa', 'SJZ 4FM6', '1050 pln', 'Tak', '22.08.2022' , 'Dodaj | Usuń'],
                    [2, 'Wymiana', 'SJZ 4FM6', '170 pln', 'Tak', '12.08.2022' , 'Dodaj | Usuń'],
                    [3, 'Gwarancja', 'SRB 24FD', '350 pln', 'Tak', '25.08.2022' , 'Dodaj | Usuń'],
                    [4, 'Naprawa', 'SJZ 9KX2', '720 pln' , 'Nie', '08.08.2022' , 'Dodaj | Usuń'],
                    [5, 'Naprawa', 'SZO FE21', '1623 pln', 'Tak', '27.07.2022' , 'Dodaj | Usuń']
                ]
            }
        }
    }
}
</script>
