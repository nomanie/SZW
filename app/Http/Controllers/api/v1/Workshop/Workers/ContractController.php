<?php

namespace App\Http\Controllers\api\v1\Workshop\Workers;

use App\Datatables\Workshop\Workers\WorkerContractDataTables;
use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Workshop\Workers\UpdateWorkerContractRequest;
use App\Http\Requests\Workshop\Workers\UpdateWorkerRequest;
use App\Http\Resources\Workshop\Workers\WorkerContractResource;
use App\Models\System\Cars\CarBrand;
use App\Models\Workshop\Mediable;
use App\Models\Workshop\Workers\Worker;
use App\Models\Workshop\Workers\WorkerContract;
use App\Services\System\LogService;
use App\Services\Workshop\Workers\ContractService;
use App\Services\Workshop\Workers\WorkerService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContractController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly WorkerService     $workerService,
        protected readonly LogService      $logService,
        protected readonly PdfGenerator    $pdfGenerator,
        protected readonly ContractService $service,
    )
    {
        //@todo dodać Permisje
        //@todo dodać logi
    }

    public function index()
    {
        $worker_id = Session::get('worker_id');
        return (new WorkerContractDataTables($worker_id))->render();
    }

    public function store(Request $request)
    {
//        $input = $request->validated();
        $input = $request->all();
        try {
            $contract = $this->service->save($input, $input['worker_id']);
            $this->logService->add($contract, $request, user()->id, new_data: $input);
        } catch(Exception $e) {
            return $this->errorJsonResponse(__('Nie udało się dodać nowej umowy'));
        }
        return $this->successJsonResponse(__('Pomyślnie dodano nową umowę'));
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
     * @param UpdateWorkerContractRequest $request
     * @param WorkerContract $workerContract
     * @return JsonResponse
     */
    public function update(UpdateWorkerContractRequest $request, WorkerContract $contract)
    {
        $input = $request->all();
        $new_contract = $this->service->save($input, $input['worker_id'], $contract);
        if ($new_contract) {
            $this->logService->add($contract, $request, user()->id, $contract->toArray(), $new_contract->toArray());
            return $this->successJsonResponse(__('Pomyślnie zmieniono umowę'));
        }
        return $this->errorJsonResponse(__('Nie udało się zmienić umowy'));
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
