<?php

namespace App\Http\Controllers\api\v1\Workshop;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorkerRequest;
use App\Models\Workers\Worker;
use App\Services\Workshop\WorkshopService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function __construct(private WorkshopService $service)
    {
        //@todo dodać Permisje
        //@todo dodać Logi
    }

    public function index(): JsonResponse
    {

    }

    public function store(CreateWorkerRequest $request): JsonResponse
    {

    }

    public function show(Worker $worker): JsonResponse
    {

    }

    public function destroy(Request $request, Worker $worker): JsonResponse
    {

    }
}
