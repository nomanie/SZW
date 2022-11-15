<?php

namespace App\Http\Controllers\api\v1\Workshop\Workers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorkerRequest;
use App\Models\Workers\Worker;
use App\Services\Workers\WorkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WorkerController extends Controller
{
    public function __construct(private WorkerService $service)
    {
        //@todo dodać Permisje
    }

    public function index(): JsonResponse
    {
        //@todo zmienić model na resource
        return Datatables::of(Worker::all())->toJson();
    }

    public function store(CreateWorkerRequest $request): JsonResponse
    {
        //@todo dorobić logi
        //@todo zrobić funkcje jsonResponse()
        $input = $request->validated();
        if ($this->service->save($input)) {
            return response()->json(['message' => 'Pomyślnie dodano pracownika']);
        }
        return response()->json(['message' => 'Nie udało się dodać nowego pracownika'], 401);
    }

    public function show(Worker $worker): JsonResponse
    {
        return response()->json($worker);
    }

    public function destroy(Request $request, Worker $worker): JsonResponse
    {
        //@todo w trakcie dorabiania logów przenieść do Service...
        if ($worker->delete()) {
            return response()->json(['message' => 'Pomyślnie usunięto pracownika']);
        }
        return response()->json(['message' => 'Nie udało się usunąć pracownika'], 401);
    }
}
