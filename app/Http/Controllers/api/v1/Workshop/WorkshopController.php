<?php

namespace App\Http\Controllers\api\v1\Workshop;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorkerRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\Workers\Worker;
use App\Models\Workshop;
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

    public function store(Request $request): JsonResponse
    {

    }

    public function show(Workshop $workshop): JsonResponse
    {

    }

    public function update(UpdateWorkshopRequest $request, Workshop $workshop)
    {
        dd($workshop);
    }

    public function destroy(Request $request, Workshop $workshop): JsonResponse
    {

    }
}
