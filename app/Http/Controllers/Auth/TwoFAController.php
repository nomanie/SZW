<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TwoFARequest;
use App\Models\System\Identity;
use App\Services\Auth\LoginService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class TwoFAController extends Controller
{
    use JsonResponseTrait;
    public function __construct(protected readonly LoginService $service)
    {}
    public function resend(Request $request)
    {
        $identity = Identity::where('email', $request->validate(['email' => 'required|email']))->first();
        $this->service->generateCode($identity->id);
        return $this->successJsonResponse(__('Kod został wysłany ponownie, sprawdź swoją skrzynkę'));
    }

    public function store(TwoFARequest $request)
    {
        $data = $request->validated();
        $identity = Identity::where('email', $data['email'])->first();
        if ($this->service->checkCode($identity->id, $data['code'])) {
            return $this->service->loginSuccess($identity, $request->getClientIp());
        }
        return $this->errorJsonResponse(__('Kod wygasł, aby się zalogować naciśnij "Wyślij kod ponownie"'));
    }
}
