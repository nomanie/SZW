<?php

namespace App\Http\Controllers\api\v1\Workshop\Workers;

use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\Workshop\Workers\WorkerContractResource;
use App\Http\Resources\Workshop\Workers\WorkerResource;
use App\Models\System\Cars\CarBrand;
use App\Models\Workshop\Mediable;
use App\Models\Workshop\Workers\Worker;
use App\Models\Workshop\Workers\WorkerContract;
use App\Services\System\LogService;
use App\Services\Workshop\Workers\WorkerService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContractController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly WorkerService  $service,
        protected readonly LogService   $logService,
        protected readonly PdfGenerator $pdfGenerator
    )
    {
        //@todo dodać Permisje
        //@todo dodać logi
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param WorkerContract $workerContract
     * @return WorkerContractResource
     */
    public function show(WorkerContract $workerContract): WorkerContractResource
    {
        return new WorkerContractResource($workerContract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorkerRequest $request
     * @param CarBrand $brand
     * @return JsonResponse
     */
    public function update(UpdateWorkerRequest $request, Worker $worker)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Worker $worker
     * @return JsonResponse
     */
    public function destroy(Request $request, Worker $worker): JsonResponse
    {

    }

    public function export(Request $request)
    {
        $data = $request->all();
        if ($request->type === 'pdf') {
            return $this->pdfGenerator
                ->setView('vendor.datatables.print')
                ->setModel('App\Models\Workshop\Workers\WorkerContract')
                ->getDataFromAjaxRequest($data)
                ->generateFilename('Umowy-pracowników')
                ->setDisk('workshop')
                ->generate();
        }
    }

    public function download(Mediable $mediable)
    {
        return $this->pdfGenerator->setMediable($mediable)->download();
    }
}
