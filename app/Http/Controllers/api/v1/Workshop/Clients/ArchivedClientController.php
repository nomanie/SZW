<?php

namespace App\Http\Controllers\api\v1\Workshop\Clients;

use App\Datatables\Workshop\Clients\ArchivedClientDataTables;
use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workshop\Clients\UpdateClientRequest;
use App\Models\Workshop\Clients\Client;
use App\Models\Workshop\Mediable;
use App\Services\System\LogService;
use App\Services\Workshop\ClientService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArchivedClientController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly ClientService  $service,
        protected readonly LogService   $logService,
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
    public function index(): JsonResponse
    {
        return (new ArchivedClientDataTables())->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param int $client_id
     * @return JsonResponse
     */
    public function update(Request $request, int $client_id)
    {
        $client = $this->service->restore($client_id);
        if ($client) {
            $this->logService->add($client, $request, new_data: $client->toArray());
            return $this->successJsonResponse(__('Pomyślnie przywrócono klienta'));
        }
        return $this->errorJsonResponse(__('Nie udało się przywrócić klienta'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Client $client
     * @return JsonResponse
     */
    public function destroy(Request $request, Client $archivedClient): JsonResponse
    {
        if (isset($request->all()['data'])) {
            $clients = Client::whereIn('id', $request->all()['data'])->get();
            foreach ($clients as $client) {
                $this->logService->add($client, $request, old_data: $client->toArray());
                $client->forceDelete();
            }
            return $this->successJsonResponse(__('Pomyślnie usunięto :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            $this->logService->add($archivedClient, $request, old_data: $archivedClient->toArray());
            if ($archivedClient->forceDelete()) {
                return $this->successJsonResponse(__('Pomyślnie usunięto klienta'));
            }
            return $this->errorJsonResponse(__('Nie udało się usunąć klienta'));
        }
    }

    public function export(Request $request)
    {
        $data = $request->all();
        if ($request->type === 'pdf') {
            return $this->pdfGenerator
                ->setView('vendor.datatables.print')
                ->setModel('App\Models\Workshop\Clients\Client')
                ->getDataFromAjaxRequest($data)
                ->generateFilename('Klienci')
                ->setDisk('workshop')
                ->generate();
        }
    }

    public function download(Mediable $mediable)
    {
        return $this->pdfGenerator->setMediable($mediable)->download();
    }
}
