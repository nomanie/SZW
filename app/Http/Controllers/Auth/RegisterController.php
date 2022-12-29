<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AccountTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\changePasswordRequest;
use App\Http\Requests\Auth\RegisterClientRequest;
use App\Http\Requests\Auth\RegisterWorkshopRequest;
use App\Models\System\Identity;
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

    public function changePassword(ChangePasswordRequest $request)
    {
        if (auth()->user()->reset_password) {
            $input = $request->validated();
            $identity = auth()->user();
            $identity->password = bcrypt($input['password']);
            $identity->reset_password = false;
            $identity->save();
            return redirect()->to($this->service->setIdentity(auth()->user()->id)->getRoute());
        }
        else auth()->logout();
    }

}
