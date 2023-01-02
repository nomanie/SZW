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
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WorkshopController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        private readonly WorkshopService $service,
        private readonly LogService      $logService,
    )
    {
        $this->middleware(WorkshopMiddleware::class);
        //@todo dodać Permisje
    }

    public function index(Request $request): WorkshopResource
    {
        return new WorkshopResource(Workshop::with('contactForm', 'places', 'additionalFields')
            ->where('identity_id', auth()->user()->id)->orWhere('id', auth()->user()->worker?->workshop_id)->first()
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

    public function upload(Request $request, Workshop $workshop)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);
        $file = $this->service->setWorkshop($workshop)->saveLogo($request->file('image'));
        if ($file) {
            return $this->successJsonResponse(__('Poprawnie zapisano logo'), 200, ['file' => $file]);
        }
        return $this->errorJsonResponse(__('Nie udało się zapisać loga'));
    }
}
