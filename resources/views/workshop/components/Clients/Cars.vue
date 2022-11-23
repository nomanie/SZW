<template>
    <div class="mt-5">
        <card :color="`orange`" :type="`list`" :table_data="items" :full_width="true"></card>
    </div>
</template>

<script>
export default {
    name: 'Cars',
    data() {
        return {
            items: {
                header_text: 'Lista Pojazdów',
                header_span: 'Ostatnio dodany 1 dzień temu',
                add_text: 'Dodaj Pojazd',
                columns: ['ID','Typ', 'Marka', 'Model', 'Rok produkcji', 'Numery Rejestracyjne', 'Akcja'],
                data: [
                    [1, 'Samochód', 'Opel', 'Astra', 1998, 'SJZ 4FM6' , 'Dodaj | Usuń'],
                    [2, 'Samochód', 'Citroen', 'C3', 2001, 'SZO 32FF' , 'Dodaj | Usuń'],
                    [3, 'Samochód', 'Dacia', 'Duster', 2017, 'SRB 24FD' , 'Dodaj | Usuń'],
                    [4, 'Samochód', 'Fiat', 'Punto', 1992 , 'SJZ 9KX2' , 'Dodaj | Usuń'],
                    [5, 'Samochód', 'Ford', 'Mondeo', '2005', 'SZO FE21' , 'Dodaj | Usuń']
                ]
            }
        }
    }
}
</script>
