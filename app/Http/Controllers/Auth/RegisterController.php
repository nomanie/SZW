<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AccountTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterClientRequest;
use App\Http\Requests\Auth\RegisterWorkshopRequest;
use App\Services\Auth\AuthService;
use App\Services\System\LogService;
use App\Traits\EmailExistsInAccountTypeTrait;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        protected AuthService $service,
        protected LogService  $logService
    )
    {
        //@todo odpalać rejestrację w tle jako joba
        //@todo dodać logi
    }

    public function registerWorkshop(RegisterWorkshopRequest $request): JsonResponse
    {
        $input = $request->validated();

        $user = $this->service->save($input, AccountTypeEnum::WORKSHOP);

        if ($user) {
            $this->logService->add($user, $request, new_data: $input);
            return $this->successJsonResponse(__('Pomylnie utworzono konto'));
        }
        return $this->errorJsonResponse(__('Nie udało się utworzyć konta'));
    }

    public function registerClient(RegisterClientRequest $request): JsonResponse
    {
        $input = $request->validated();

        $user = $this->service->save($input, AccountTypeEnum::CLIENT);

        if ($user) {
            $this->logService->add($user, $request, new_data: $input);
            return $this->successJsonResponse(__('Pomylnie utworzono konto'));
        }
        return $this->errorJsonResponse(__('Nie udało się utworzyć konta'));
    }

}
