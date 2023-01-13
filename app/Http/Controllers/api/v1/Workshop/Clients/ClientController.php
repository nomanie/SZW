<?php

namespace App\Http\Controllers\api\v1\Workshop\Clients;

use App\Datatables\Workshop\Clients\ClientDataTables;
use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workshop\Clients\CreateClientRequest;
use App\Http\Requests\Workshop\Clients\UpdateClientRequest;
use App\Http\Resources\Workshop\ClientResource;
use App\Models\Workshop\Clients\Client;
use App\Models\Workshop\Mediable;
use App\Services\System\LogService;
use App\Services\Workshop\ClientService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
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
        return (new ClientDataTables())->render();
    }

    public function store(CreateClientRequest $request): JsonResponse
    {
        $input = $request->validated();
        try {
            $client = $this->service->saveOrUpdate($input);
            if ($client) {
                $this->logService->add($client, $request, new_data: $input);
                return $this->successJsonResponse(__('Pomyślnie dodano klienta'));
            }
        } catch (\Exception $e) {
            return $this->errorJsonResponse(__('Nie udało się dodać nowego klienta'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return ClientResource
     */
    public function show(Client $client): ClientResource
    {
        Session::put('client_id', $client->id);
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param Client $client
     * @return JsonResponse
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $input = $request->validated();
        $old_client = $client->toArray();
        $newClient = $this->service->saveOrUpdate($input, $client);
        if ($newClient) {
            $this->logService->add($client, $request, old_data: $old_client, new_data: $input);
            return $this->successJsonResponse(__('Pomyślnie edytowano klienta'));
        }
        return $this->errorJsonResponse(__('Edycja klienta nie udała się'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Client $client
     * @return JsonResponse
     */
    public function destroy(Request $request, Client $client): JsonResponse
    {
        if (isset($request->all()['data'])) {
            $clients = Client::whereIn('id', $request->all()['data'])->get();
            foreach ($clients as $client) {
                $this->logService->add($client, $request, old_data: $client->toArray());
                $client->delete();
            }
            return $this->successJsonResponse(__('Pomyślnie zarchiwizowano :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            $this->logService->add($client, $request, old_data: $client->toArray());
            if ($client->delete()) {
                return $this->successJsonResponse(__('Pomyślnie zarchiwizowano klienta'));
            }
            return $this->errorJsonResponse(__('Nie udało się zarchiwizować klienta'));
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
