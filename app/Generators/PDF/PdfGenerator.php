<?php

namespace App\Generators\PDF;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;

class PdfGenerator
{

    protected mixed $data;
    protected string $view;
    protected string $filename;
    protected string $model;
    protected string $path;
    protected $pdf;
    protected string $disk;

    public function __construct()
    {
        $this->pdf = app('snappy.pdf.wrapper');
    }

    public function getDataFromAjaxRequest(mixed $data): static
    {
        $this->data = (new $this->model)->whereIn('id', $data['ids'])->get($data['columns'])->toArray();

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

    public function generateFilename(string $filename):static
    {
        $this->filename = $filename . '_' . (new \Carbon\Carbon)->getTimestamp() . '.pdf';

        return $this;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFile(): string
    {
        return 'storage/' . $this->path;
    }

    public function setPath(string $path): static
    {

        $this->path = str_replace('-', '/', $path);
        $this->setFilename(Arr::last(explode('/', $this->path)));

        return $this;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function generate(): static
    {
        $data = $this->data;
        $view = view($this->view, compact('data'));
        $this->path = storage_path('app/' . $this->disk . 's/exports/' . $this->filename);
        $this->pdf->generateFromHtml($view, $this->path);
        $this->setPublicPath();
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
                'Content-Type' => 'application/pdf'
            ]
        );
    }

    public function getFileInUrl(): string
    {
        $file = Storage::url($this->path);

        return str_replace('/', '-', $this->path);
    }

    public function setDisk(string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function setPublicPath(): static
    {
        $this->path = explode('storage/',$this->path)[1];

        return $this;
    }
}
