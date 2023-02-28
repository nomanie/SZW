<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPUnit\Util\Exception;

class LoginController extends Controller
{
    public function __construct(protected AuthService $service){}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, $request->get('remember_me'))) {
            $service = $this->service->setIdentity(auth()->user()->id);
            if ($service->checkIfMustChangePassword()) {
                return response()->json([
                    'route' => 'change-password',
                ]);
            }

            try {
                $service->addTypesToSession()->addIdToSession()->setToken(exec('getmac'), $request->getClientIp());
            } catch (Exception $e) {
                Auth::logout();
            }
            return response()->json([
                'route' => $this->service->getRoute(),
                'id' => $this->service->getUuid(),
                'token' => $this->service->getToken(exec('getmac'), $request->getClientIp()),
                'type' => $this->service->getType()
            ]);
        }
        return response()->json(['errors' => ['password' => [0 => 'Hasło jest niepoprawne']]], 422);

    }

    public function logout(Request $request)
    {
        $this->service->setIdentity(auth()->user()->id)->logout(exec('getmac'), $request->getClientIp());

        return redirect('/login');
    }
}
