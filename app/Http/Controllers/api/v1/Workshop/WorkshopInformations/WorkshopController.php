<?php

namespace App\Http\Controllers\api\v1\Workshop\WorkshopInformations;

use App\Http\Controllers\Controller;
use App\Http\Middleware\WorkshopMiddleware;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\System\Workshop;
use App\Services\System\LogService;
use App\Services\Workshop\WorkshopService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private WorkshopService $service,
        private LogService $logService,
    )
    {
        $this->middleware(WorkshopMiddleware::class);
        //@todo dodać Permisje
        //@todo dodać Logi
    }

    public function show(Workshop $workshop): JsonResponse
    {
       // zwracamy resource
    }

    public function update(UpdateWorkshopRequest $request, Workshop $workshop)
    {
        //@todo aktualizacja danych przy zapisie
    }
}
