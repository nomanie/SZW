<?php
namespace App\Generators\PDF;

use App\Enums\Workshop\MediableTypeEnum;
use App\Models\Workshop\Mediable;
use App\Services\Workshop\MediableService;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Spatie\Browsershot\Browsershot;

class InvoiceGenerator
{
    protected mixed $data;
    protected string $view;
    protected string $filename;
    protected string $model;
    protected string $path = 'documents/';
    protected $pdf;
    protected string $disk;
    protected Mediable $mediable;

    public function __construct(
        protected MediableService $mediableService
    )
    {
        $this->pdf = app('dompdf.wrapper');
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function setData(mixed $data): static
    {
        $this->data = $data->toArray();

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

    public function generate()
    {
        $data = $this->data;
        $view = view($this->view, compact('data'))->render();
        $path = storage_path('app/' . $this->disk . 's/' . $this->path . $this->filename);
//        $pdf = $this->pdf->loadHtml($view)->save($path);
//        Storage::disk($this->disk)->put($this->path . $this->filename, '');

        return Browsershot::html('<h1>test</h1>')
            ->setNodeBinary('PATH %~dp0;%PATH%;')
            ->setNpmBinary('PATH %~dp0;%PATH%;')
            ->setBinPath(base_path('vendor/spatie/browsershot/bin/browser.js'))
            ->setNodeModulePath(base_path('node_modules'))
            ->setChromePath('C:\Program Files\Google\Chrome\Application\chrome.exe')
            ->showBackground()
            ->windowSize(1920, 1080)
            ->format('A4')
            ->waitUntilNetworkIdle()
            ->showBrowserHeaderAndFooter()
            ->base64pdf();

        $size = Storage::disk($this->disk)->size($this->path . $this->filename);

        return $this->mediableService->setDisk($this->disk)
            ->setExtension('.pdf')
            ->setFilename($this->filename)
            ->setSize($size)
            ->setType(MediableTypeEnum::INVOICE)
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
