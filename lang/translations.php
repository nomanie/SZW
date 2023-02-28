<?php
namespace lang;
// na początku tłumaczeń wstawiamy tekst zależny gdzie jest umieszczony
// tekst, przycisk, placeholder, komunikat -> toast , input -> label inputa, link -> hiperłącze bez buttona (np. sidebar)
//
// na koniec dodajemy w () scieżkę gdzie znajduje się tłumaczenie, np. Pracownicy - Lista pracowników
// przykładowe lokalizacje:
// Pracownicy -> Lista pracowników | Pracownicy -> Dodawanie pracownika
// Pracownicy -> Edycja pracownika | Pracownicy -> Podgląd -> Umowy
//
// struktura tabeli:
// translations: id,model,type,place,text
// translations_polish: id,translation_id,translated_text
// translate_english: id,translation_id,translated_text
//@todo zrobić JOB'a który pobierze tablice i doda nowe rekordy jeśli nie istnieją takie, dodawać ma tylko do głównej tabeli z translates
//@todo oraz JOB'a który będzie generował z bazy danych JSON'a z tłumaczeniami
return [
    'Identity' => [
        // tutaj tłumaczenia kolumn,
        'id' => 'ID identyfikacji',
    ],
    'Others' => [
        // tutaj tłumaczenie tekstów na stronie
        "link Klienci (Sidebar)" => 'Klienci'
    ]
];
