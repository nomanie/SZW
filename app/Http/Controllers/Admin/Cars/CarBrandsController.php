<?php

namespace App\Http\Controllers\Admin\Cars;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Cars\StoreCarBrandRequest;
use App\Http\Requests\System\Cars\UpdateCarBrandRequest;
use App\Http\Resources\Admin\Cars\BrandResource;
use App\Models\System\Cars\CarBrand;
use App\Services\System\Cars\CarBrandService;
use App\Generators\PDF\PdfGenerator;
use App\Services\System\LogService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CarBrandsController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        protected CarBrandService $service,
        protected LogService $logService,
        protected PdfGenerator $pdfGenerator
    )
    {
        //@todo dodać permisje
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(CarBrand::all())
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.cars.brand');
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
            $this->logService->add($brand, $request, old_data: $brand->toArray(), new_data: $input);
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
    public function destroy(Request $request, int $brand): JsonResponse
    {
        if (isset($request->all()['data'])) {
            $carBrands = CarBrand::whereIn('id', $request->all()['data'])->get();
            foreach ($carBrands as $br) {
                $this->logService->add($br, $request, old_data: $br->toArray());
                $br->delete();
            }
            return $this->successJsonResponse(__('Pomyślnie usunięto :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            $brand = CarBrand::find($brand);
            $this->logService->add($brand, $request, old_data: $brand->toArray());
            if ($brand->delete()) {
                return $this->successJsonResponse(__('Pomyślnie usunięto markę'));
            }
            return $this->errorJsonResponse(__('Nie udało się usunąć marki'));
        }

    }

    public function export(Request $request)
    {
        $data = $request->all();
        if ($request->type === 'pdf') {
            $this->pdfGenerator
                ->setView('vendor.datatables.print')
                ->setModel('App\Models\System\Cars\CarBrand')
                ->getDataFromAjaxRequest($data)
                ->setFilename('Marki_samochodow')
                ->generate();
        }

        return $this->pdfGenerator->getFile();
    }

    public function download()
    {
        return $this->pdfGenerator->download();
    }

}
