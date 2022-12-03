<?php

namespace App\Generators\PDF;

class PdfGenerator
{

    protected mixed     $data;
    protected string    $view;
    protected string    $filename;
    protected string    $model;
    protected string    $path;
    protected           $pdf;

    public function __construct()
    {
        $this->pdf = app('snappy.pdf.wrapper');
    }

    public function getDataFromAjaxRequest(mixed $data): static
    {
        $this->data = (new $this->model)->select($data['columns'])->whereIn('id', $data['ids'])->get()->toArray();

        return $this;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function setData(mixed $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function setView(string $view): static
    {
        $this->view = $view;

        return $this;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename . '_' . (new \Carbon\Carbon)->getTimestamp()  . '.pdf';

        return $this;
    }

    public function getFile(): string
    {
        return $this->path;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function generate(): static
    {
        $data = $this->data;
        $view = view($this->view, compact('data'));
        $this->path = storage_path('tmp/' . $this->filename);

        $this->pdf->generateFromHtml($view, $this->path);

        return $this;
    }

    public function inline(): string
    {
        $data = $this->data;
        $view = view($this->view, compact('data'));
        $this->pdf->loadHTML($view);
        return $this->pdf->inline();
    }

    public function download(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download($this->getFile(), $this->filename,
            [
            'Content-Type'=> 'application/pdf'
            ]
        );
    }
}
