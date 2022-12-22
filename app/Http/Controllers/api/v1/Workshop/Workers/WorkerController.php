<?php

namespace App\Http\Controllers\api\v1\Workshop\Workers;

use App\Datatables\Workshop\Workers\WorkerDataTables;
use App\Generators\PDF\PdfGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\Workshop\Workers\WorkerResource;
use App\Models\System\Cars\CarBrand;
use App\Models\Workshop\Mediable;
use App\Models\Workshop\Workers\Worker;
use App\Services\System\LogService;
use App\Services\Workshop\Workers\WorkerService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class WorkerController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly WorkerService  $service,
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
        return (new WorkerDataTables)->render();
    }

    public function store(CreateWorkerRequest $request): JsonResponse
    {
        $input = $request->validated();
        try {
            $worker = $this->service->saveOrUpdate($input);
            if ($worker) {
                $this->logService->add($worker, $request, new_data: $input);
                return $this->successJsonResponse(__('Pomyślnie dodano pracownika'));
            }
        } catch(\Exception $e) {
            return $this->errorJsonResponse(__('Nie udało się dodać nowego pracownika'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Worker $worker
     * @return WorkerResource
     */
    public function show(Worker $worker): WorkerResource
    {
        return new WorkerResource($worker);
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
        $input = $request->validated();
        $newWorker = $this->service->saveOrUpdate($input, $worker);

        if ($newWorker) {
            $this->logService->add($worker, $request, old_data: $worker->toArray(), new_data: $input);
            return $this->successJsonResponse(__('Pomyślnie edytowano Pracownika'));
        }
        return $this->errorJsonResponse(__('Edycja pracownika nie udała się'));
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
        if (isset($request->all()['data'])) {
            $workers = Worker::whereIn('id', $request->all()['data'])->get();
            foreach ($workers as $wr) {
                $this->logService->add($wr, $request, old_data: $wr->toArray());
                $wr->delete();
            }
            return $this->successJsonResponse(__('Pomyślnie usunięto :count rekordów', ['count' => count($request->all()['data'])]));
        } else {
            $this->logService->add($worker, $request, old_data: $worker->toArray());
            if ($worker->delete()) {
                return $this->successJsonResponse(__('Pomyślnie usunięto pracownika'));
            }
            return $this->errorJsonResponse(__('Nie udało się usunąć pracownika'));
        }
    }

    public function export(Request $request)
    {
        $data = $request->all();
        if ($request->type === 'pdf') {
            return $this->pdfGenerator
                ->setView('vendor.datatables.print')
                ->setModel('App\Models\Workshop\Workers\Worker')
                ->getDataFromAjaxRequest($data)
                ->generateFilename('Pracownicy')
                ->setDisk('workshop')
                ->generate();
        }
    }

    public function download(Mediable $mediable)
    {
        return $this->pdfGenerator->setMediable($mediable)->download();
    }
}
