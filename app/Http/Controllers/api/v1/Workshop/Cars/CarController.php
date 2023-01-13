<?php

namespace App\Http\Controllers\api\v1\Workshop\Cars;

use App\Datatables\Workshop\Cars\CarsDataTables;
use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workshop\Cars\CreateCarRequest;
use App\Http\Requests\Workshop\Cars\UpdateCarRequest;
use App\Http\Resources\Workshop\CarResource;
use App\Models\Workshop\Cars\Car;
use App\Models\Workshop\Mediable;
use App\Services\System\LogService;
use App\Services\Workshop\CarService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly CarService $service,
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
    public function index(): string
    {
//        return (new CarsDataTables())->render();
        return Car::whereNull('deleted_at')->where('client_id', Session::get('client_id'))->get()->toJson();
    }

    public function store(CreateCarRequest $request): JsonResponse
    {
        $input = $request->validated();
        try {
            $client = $this->service->saveOrUpdate($input);
            if ($client) {
                $this->logService->add($client, $request, new_data: $input);
                return $this->successJsonResponse(__('Pomyślnie dodano pojazd'));
            }
        } catch (\Exception $e) {
            return $this->errorJsonResponse(__('Nie udało się dodać nowego pojazdu'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Car $car
     * @return CarResource
     */
    public function show(Car $car): CarResource
    {
        Session::put('client_id', $car->id);
        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarRequest $request
     * @param Car $car
     * @return JsonResponse
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $input = $request->validated();
        $old_car = $car->toArray();
        $new_car = $this->service->saveOrUpdate($input, $car);
        if ($new_car) {
            $this->logService->add($car, $request, old_data: $old_car, new_data: $input);
            return $this->successJsonResponse(__('Pomyślnie edytowano pojazd'));
        }
        return $this->errorJsonResponse(__('Edycja pojazdu nie udała się'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Car $client
     * @return JsonResponse
     */
    public function destroy(Request $request, Car $car): JsonResponse
    {
        if (isset($request->all()['data'])) {
            $cars = Car::whereIn('id', $request->all()['data'])->get();
            foreach ($cars as $car) {
                $this->logService->add($car, $request, old_data: $car->toArray());
                $car->delete();
            }
            return $this->successJsonResponse(__('Pomyślnie zarchiwizowano :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            $this->logService->add($car, $request, old_data: $car->toArray());
            if ($car->delete()) {
                return $this->successJsonResponse(__('Pomyślnie zarchiwizowano pojazd'));
            }
            return $this->errorJsonResponse(__('Nie udało się zarchiwizować pojazdu'));
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
