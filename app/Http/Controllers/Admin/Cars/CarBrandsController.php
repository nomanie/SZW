<?php

namespace App\Http\Controllers\Admin\Cars;

use App\DataTables\Admin\Cars\CarBrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\Cars\StoreCarBrandRequest;
use App\Http\Requests\System\Cars\UpdateCarBrandRequest;
use App\Models\System\Cars\CarBrand;
use App\Services\System\Cars\CarBrandService;
use App\Services\System\LogService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarBrandsController extends Controller
{
    use JsonResponseTrait;

    public function __construct(protected CarBrandService $service, protected LogService $logService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(CarBrandDatatable $dataTable)
    {
        return $dataTable->render('admin.pages.cars.brand');
        //return (new CarBrandDatatable)->builder();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\System\Cars\StoreCarBrandRequest  $request
     * @return JsonResponse
     */
    public function store(StoreCarBrandRequest $request): JsonResponse
    {
        $input = $request->validated();
        $brand = $this->service->save($input);

        if ($brand) {
            $this->logService->add($brand, $request, new_data: $input);
            return $this->successJsonResponse(__('Pomyślnie dodano markę'));
        }
        return $this->errorJsonResponse(__('Nie udało się dodać marki'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System\Cars\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function show(CarBrand $carBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System\Cars\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(CarBrand $carBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\System\Cars\UpdateCarBrandRequest  $request
     * @param  \App\Models\System\Cars\CarBrand  $carBrand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarBrandRequest $request, CarBrand $carBrand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System\Cars\CarBrand  $carBrand
     * @return JsonResponse
     */
    public function destroy(Request $request, CarBrand $carBrand): JsonResponse
    {
        if (count($request->all()['data']) > 0) {
            //usuwanie wielu rekordów
            $carBrands = CarBrand::whereIn('id', $request->all()['data'])->get();
            foreach ($carBrands as $brand) {
                $this->logService->add($brand, $request, old_data: $brand->toArray());
                $brand->delete();
            }
            return $this->successJsonResponse(__('Pomyślnie usunięto :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            //usuwanie jednego rekordu
            $this->logService->add($carBrand, $request, old_data: $carBrand->toArray());
            if ($carBrand->delete()) {
                return $this->successJsonResponse(__('Pomyślnie usunięto markę'));
            }
            return $this->errorJsonResponse(__('Nie udało się usunąć marki'));
        }

    }
}
