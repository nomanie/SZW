<?php

namespace App\Http\Controllers\api\v1\Workshop\Documents;

use App\Datatables\Workshop\Clients\ClientDataTables;
use App\Datatables\Workshop\Documents\DocumentDataTables;
use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workshop\Clients\CreateClientRequest;
use App\Http\Requests\Workshop\Clients\UpdateClientRequest;
use App\Http\Requests\Workshop\Documents\CreateDocumentRequest;
use App\Http\Requests\Workshop\Documents\UpdateDocumentRequest;
use App\Http\Resources\Workshop\ClientResource;
use App\Http\Resources\Workshop\Documents\DocumentResource;
use App\Models\Workshop\Clients\Client;
use App\Models\Workshop\Documents\Document;
use App\Models\Workshop\Mediable;
use App\Services\System\LogService;
use App\Services\Workshop\Documents\DocumentService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly DocumentService $service,
        protected readonly LogService $logService,
        protected readonly PdfGenerator $pdfGenerator
    )
    {
        //@todo dodać Permisje
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        if ($request->type === 'client') {
            return (new DocumentDataTables(client_id: $request->id))->render();
        } else if ($request->type === 'car') {
            return (new DocumentDataTables(car_id: $request->id))->render();
        }

        return (new DocumentDataTables())->render();
    }

    public function store(CreateDocumentRequest $request): JsonResponse
    {
        dd($request->all());
        $input = $request->validated();
        try {
            $document = $this->service->saveOrUpdate($input);
            if ($document) {
                $this->logService->add($document, $request, new_data: $input);
                return $this->successJsonResponse(__('Pomyślnie dodano dokument'));
            }
        } catch (\Exception $e) {
            return $this->errorJsonResponse(__('Nie udało się dodać nowego dokumentu'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     * @return DocumentResource
     */
    public function show(Document $document): DocumentResource
    {
        Session::put('client_id', $document->id);
        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDocumentRequest $request
     * @param Document $document
     * @return JsonResponse
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $input = $request->validated();
        $old_document = $document->toArray();
        $new_document = $this->service->saveOrUpdate($input, $document);
        if ($new_document) {
            $this->logService->add($document, $request, old_data: $old_document, new_data: $input);
            return $this->successJsonResponse(__('Pomyślnie edytowano dokument'));
        }
        return $this->errorJsonResponse(__('Edycja dokumentu nie udała się'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Document $document
     * @return JsonResponse
     */
    public function destroy(Request $request, Document $document): JsonResponse
    {
        if (isset($request->all()['data'])) {
            $documents = Document::whereIn('id', $request->all()['data'])->get();
            foreach ($documents as $document) {
                $this->logService->add($document, $request, old_data: $document->toArray());
                $document->delete();
            }
            return $this->successJsonResponse(__('Pomyślnie zarchiwizowano :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            $this->logService->add($document, $request, old_data: $document->toArray());
            if ($document->delete()) {
                return $this->successJsonResponse(__('Pomyślnie zarchiwizowano dokument'));
            }
            return $this->errorJsonResponse(__('Nie udało się zarchiwizować dokumentu'));
        }
    }

    public function export(Request $request)
    {
        $data = $request->all();
        if ($request->type === 'pdf') {
            return $this->pdfGenerator
                ->setView('vendor.datatables.print')
                ->setModel('App\Models\Workshop\Documents\Document')
                ->getDataFromAjaxRequest($data)
                ->generateFilename('Dokumenty')
                ->setDisk('workshop')
                ->generate();
        }
    }

    public function download(Mediable $mediable)
    {
        return $this->pdfGenerator->setMediable($mediable)->download();
    }
}
