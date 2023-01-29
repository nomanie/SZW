<?php

namespace App\Services\Workshop\Documents;

use App\Models\Workshop\Documents\Document;
use App\Models\Workshop\Documents\DocumentContent;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Comment\Doc;

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

    public function saveOrUpdate(array $data, Document $document = null): Document|bool
    {
        $document = $this->saveDocument($data);
        $contents = $this->saveContents($data['contents']);

        if ($document && $contents) {
            return $this->document;
        }
        return false;
    }

    public function saveDocument(array $data): bool
    {
        $this->document = new Document();
        $this->document->client_id = $data['client_id'];
        $this->document->fv_header = $data['fv_header'];
        $this->document->issue_date = $data['issue_date'];
        $this->document->sold_date = $data['sold_date'];
        $this->document->issuer_name = $data['issuer_name'];
        $this->document->issuer_address = $data['issuer_address'];
        $this->document->issuer_nip = $data['issuer_nip'];
        $this->document->recipient_name = $data['recipient_name'];
        $this->document->recipient_address = $data['recipient_address'];
        $this->document->recipient_nip = $data['recipient_nip'];
        $this->document->sum_vat = $data['sum_vat'];
        $this->document->sum_net = $data['sum_net'];
        $this->document->sum_gross = $data['sum_gross'];
        $this->document->payment_date = $data['payment_date'];
        $this->document->payment_type = $data['payment_type']['value'];
        $this->document->bank_type = 1; //$data['bank_type'];
        $this->document->account_number = $data['account_number'];
        $this->document->comments = $data['notes']['value'];
        $this->document->fv_number = $data['fv_number'];

        if ($this->document->save()) {
            return true;
        }
        return false;
    }
    public function saveContents(array $data): bool
    {
        $saved = 0;
        foreach ($data as $position) {
            $content = new DocumentContent();
            $content->document_id = $this->document->id;
            $content->name = $position['name'];
            $content->sum_net = $position['sum_net'];
            $content->sum_vat = $position['sum_vat'];
            $content->sum_gross = $position['sum_gross'];
            $content->units = $position['units'];
            $content->unit_net = $position['unit_net'];
            $content->vat_rate_id = $position['vat_rate_id']['value'];
            if ($content->save()) {
                $saved++;
            }
        }
        return $saved === count($data);
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
