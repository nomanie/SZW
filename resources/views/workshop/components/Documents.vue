<template>
    <div class="mt-5">
        <card :color="`blue`" :type="`list`" :table_data="items" :full_width="true"></card>
    </div>
</template>

<script>
export default {
    name: 'Documents',
    data() {
        return {
            items: {
                header_text: 'Lista Dokumentów',
                header_span: 'Ostatnio dodany 2 godzin temu',
                add_text: 'Dodaj Dokument',
                columns: ['ID', 'Typ', 'Przypisany do', 'Kwota', 'Zapłacone', 'Akcja'],
                data: [
                    [1, 'Faktura', 'SJZ 4FM6', '1050 pln', 'Tak' , 'Dodaj | Usuń'],
                    [2, 'Faktura', 'SJZ 4FM6', '170 pln', 'Tak' , 'Dodaj | Usuń'],
                    [3, 'Faktura', 'SRB 24FD', '350 pln', 'Tak' , 'Dodaj | Usuń'],
                    [4, 'Faktura', 'SJZ 9KX2', '720 pln' , 'Nie' , 'Dodaj | Usuń'],
                    [5, 'Faktura', 'SZO FE21', '1623 pln', 'Tak' , 'Dodaj | Usuń']
                ]
            }
        }
    }
}
</script>
