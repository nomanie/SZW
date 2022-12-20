<?php

namespace App\Generators\PDF;

use App\Enums\Workshop\MediableTypeEnum;
use App\Models\Workshop\Mediable;
use App\Services\Workshop\MediableService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PdfGenerator
{

    protected mixed $data;
    protected string $view;
    protected string $filename;
    protected string $model;
    protected string $path = 'exports/';
    protected $pdf;
    protected string $disk;
    protected Mediable $mediable;

    public function __construct(
        protected MediableService $mediableService
    )
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

    public function generateFilename(string $filename): static
    {
        $this->filename = $filename . '_' . (new \Carbon\Carbon)->getTimestamp() . '.pdf';

        return $this;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function generate(): Mediable
    {
        $data = $this->data;
        $view = view($this->view, compact('data'));
        $path = storage_path('app/' . $this->disk . 's/' . $this->path . $this->filename);
        $this->pdf->generateFromHtml($view, $path);
        $size = Storage::disk($this->disk)->size($this->path . $this->filename);

        return $this->mediableService->setDisk($this->disk)
            ->setExtension('.pdf')
            ->setFilename($this->filename)
            ->setSize($size)
            ->setType(MediableTypeEnum::EXPORT)
            ->store();
    }

    public function inline(): string
    {
        $data = $this->data;
        $view = view($this->view, compact('data'));
        $this->pdf->loadHTML($view);
        return $this->pdf->inline();
    }

    public function download(): StreamedResponse
    {
        return Storage::disk($this->disk)->download($this->path . $this->filename);
    }

    public function setDisk(string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function setMediable(Mediable|int $mediable): static
    {
        if (gettype($mediable) === 'int') {
            $mediable = Mediable::find($mediable);
        }
        $this->mediable = $mediable;
        $this->disk = $this->mediable->disk;
        $this->filename = $this->mediable->name . $this->mediable->extension;
        $this->path = MediableTypeEnum::getPath($this->mediable->type);
        return $this;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }
}
