<?php

namespace App\Http\Controllers\api\v1\Workshop\Cars;

use App\Datatables\Workshop\Cars\ArchivedCarDataTables;
use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workshop\Clients\UpdateClientRequest;
use App\Models\Workshop\Cars\Car;
use App\Models\Workshop\Clients\Client;
use App\Models\Workshop\Mediable;
use App\Services\System\LogService;
use App\Services\Workshop\CarService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArchivedCarController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly CarService  $service,
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
        return (new ArchivedCarDataTables())->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param int $client_id
     * @return JsonResponse
     */
    public function update(Request $request, int $car_id)
    {
        $car = $this->service->restore($car_id);
        if ($car) {
            $this->logService->add($car, $request, new_data: $car->toArray());
            return $this->successJsonResponse(__('Pomyślnie przywrócono pojazd'));
        }
        return $this->errorJsonResponse(__('Nie udało się przywrócić pojazdu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Car $car
     * @return JsonResponse
     */
    public function destroy(Request $request, Car $archivedCar): JsonResponse
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
                ->setModel('App\Models\Workshop\Cars\Car')
                ->getDataFromAjaxRequest($data)
                ->generateFilename('Samochody')
                ->setDisk('workshop')
                ->generate();
        }
    }

    public function download(Mediable $mediable)
    {
        return $this->pdfGenerator->setMediable($mediable)->download();
    }
}
