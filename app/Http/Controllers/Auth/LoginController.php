<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Exception;

class LoginController extends Controller
{
    public function __construct(protected LoginService $service){}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->login($data, $request->get('remember_me'), $request->getClientIp());
        if ($response === 1) {
            return response()->json([
                'route' => $this->service->getRoute(),
                'id' => $this->service->getUuid(),
                'token' => $this->service->getToken(exec('getmac'), $request->getClientIp()),
                'type' => $this->service->getType()
            ]);
        } else if ($response === 2) {
            return response()->json([
                'route' => 'change-password',

            ]);
        } else if ($response === 3) {
            return response()->json([
                'route' => 'login-next',
            ]);
        }
        else {
            return response()->json(['errors' => ['password' => [0 => 'Hasło jest niepoprawne']]], 422);
        }

    }

    public function logout(Request $request)
    {
        $this->service->setIdentity(auth()->user()->id)->logout(exec('getmac'), $request->getClientIp());

        return redirect('/login');
    }

    public function insertPin(Request $request)
    {

    }
}
