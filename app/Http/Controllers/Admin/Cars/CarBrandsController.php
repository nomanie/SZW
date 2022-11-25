<?php

namespace App\Http\Controllers\Admin\Cars;

use App\Http\Controllers\Controller;
use App\DataTables\Admin\Cars\CarBrandDataTable;
use App\Http\Requests\System\Cars\StoreCarBrandRequest;
use App\Http\Requests\System\Cars\UpdateCarBrandRequest;
use App\Http\Resources\Admin\Cars\BrandResource;
use App\Models\System\Cars\CarBrand;
use App\Services\System\Cars\CarBrandService;
use App\Services\System\LogService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarBrandsController extends Controller
{
    use JsonResponseTrait;

    public function __construct(protected CarBrandService $service, protected LogService $logService)
    {
        //@todo dodać permisje
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function index(CarBrandDataTable $dataTable)
    {
        return $dataTable->setFilename('Marki_samochodów')->render('admin.pages.cars.brand');
//        return DataTables::of(CarBrand::all())
//            ->addColumn('action', '')
//            ->addIndexColumn()
//            ->rawColumns(['action'])->make();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarBrandRequest $request
     * @return JsonResponse
     */
    public function store(StoreCarBrandRequest $request): JsonResponse
    {
        $input = $request->validated();
        $brand = $this->service->saveOrUpdate($input);

        if ($brand) {
            $this->logService->add($brand, $request, new_data: $input);
            return $this->successJsonResponse(__('Pomyślnie dodano markę'));
        }
        return $this->errorJsonResponse(__('Nie udało się dodać marki'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarBrand $brand
     * @return BrandResource
     */
    public function edit(CarBrand $brand): BrandResource
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarBrandRequest $request
     * @param CarBrand $brand
     * @return JsonResponse
     */
    public function update(UpdateCarBrandRequest $request, CarBrand $brand)
    {
        $input = $request->validated();
        $newBrand = $this->service->saveOrUpdate($input, $brand);

        if ($newBrand) {
            $this->logService->add($brand, $request, old_data: $brand->toArray() ,new_data: $input);
            return $this->successJsonResponse(__('Pomyślnie Edytowano markę'));
        }
        return $this->errorJsonResponse(__('Edycja marki nie powiodła się'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CarBrand $brand
     * @return JsonResponse
     */
    public function destroy(Request $request, CarBrand $brand): JsonResponse
    {
        if (isset($request->all()['data'])) {
            $carBrands = CarBrand::whereIn('id', $request->all()['data'])->get();
            foreach ($carBrands as $br) {
                $this->logService->add($br, $request, old_data: $br->toArray());
                $br->delete();
            }
            return $this->successJsonResponse(__('Pomyślnie usunięto :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            $this->logService->add($brand, $request, old_data: $brand->toArray());
            if ($brand->delete()) {
                return $this->successJsonResponse(__('Pomyślnie usunięto markę'));
            }
            return $this->errorJsonResponse(__('Nie udało się usunąć marki'));
        }

    }
}
