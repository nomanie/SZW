<?php

namespace App\Http\Controllers\api\v1\Workshop\WorkshopInformations;

use App\Http\Controllers\Controller;
use App\Http\Middleware\WorkshopMiddleware;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Http\Resources\Workshop\WorkshopInformations\WorkshopResource;
use App\Models\System\Workshop;
use App\Services\System\LogService;
use App\Services\Workshop\WorkshopService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
    }

    public function index(Request $request): WorkshopResource
    {
        return new WorkshopResource(Workshop::with('contactForm', 'places', 'additionalFields')
            ->where('identity_id', auth()->user()->id)->first()
        );
    }

    public function update(UpdateWorkshopRequest $request, Workshop $workshop)
    {
        $new_data = $this->service->setWorkshop($workshop)->update($request->all());
        if ($new_data) {
            $this->logService->add($workshop, $request, auth()->user()->id, $workshop->toArray(), $new_data->toArray());
            return $this->successJsonResponse(__('Pomyślnie zapisano dane'));
        }
        return $this->errorJsonResponse(__('Dane nie zostały zapisane'));
    }
}
