<?php

namespace App\Services\Workshop\Documents;

use App\Models\Workshop\Documents\Document;

class DocumentService
{
    public function __construct(protected Document $document)
    {}

    public function setDocument(Document|int $document): static
    {
        if (gettype($document) === 'int') {
            $document = Document::find($document);
        }
        $this->document = $document;
    }

    public function saveOrUpdate(): Document|bool
    {

    }

    public function prepareDataToSave(): array
    {
        //@todo przygotowanie danych do zapisania
    }

    public function getDocumentNumber(): string
    {
        //@todo zwraca kolejny dostępny numer dokumentu
    }

    public function generate()
    {
        //@todo generowanie pliku pdf
    }

    public function send()
    {
        //@todo wysyłanie dokumentu na maila
    }
}
